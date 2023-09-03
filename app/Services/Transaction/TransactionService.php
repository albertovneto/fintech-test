<?php

namespace App\Services\Transaction;

use App\Entities\TransactionEntity;
use App\Repositories\Contract\TransactionRepositoryInterface;
use App\Dto\{
    PaymentValueDto,
    TransactionInputCreateDto,
    TransactionInputDto,
    TransactionOutputDto,
    WalletUpdateInputDto
};
use App\Services\{
    AccountService,
    WalletService
};

class TransactionService
{
    public function __construct(
        private TransactionRepositoryInterface $transactionRepository,
        private PaymentMethod $paymentMethod,
        private AccountService $accountService,
        private WalletService $walletService
    ) {
    }

    public function execute(TransactionInputDto $transactionInputDto)
    {
        $accountData = $this->accountService->getByAccountId($transactionInputDto->accountId);

        $transactionInputDto->setBalance($accountData->wallet->balance);
        $paymentValue = $this->paymentMethod
            ->method($transactionInputDto->paymentMethod)
            ->paymentValue($transactionInputDto);

        $walletUpdateInputDto = new WalletUpdateInputDto(
            id: $accountData->wallet->id,
            accountId: $accountData->id,
            balance: $this->walletService->balanceDiscount($accountData->wallet->balance, $paymentValue->totalValue)
        );

        $updatedWalletData = $this->walletService->update($walletUpdateInputDto);
        $this->storeTransactionInfo($paymentValue, $transactionInputDto);

        return new TransactionOutputDto($accountData->id, $updatedWalletData->balance);
    }

    private function storeTransactionInfo(
        PaymentValueDto $paymentValueDto,
        TransactionInputDto $transactionInputDto
    ): TransactionEntity {
        $transactionInputCreateDto = new TransactionInputCreateDto(
            accountId: $transactionInputDto->accountId,
            transactionValue: $paymentValueDto->transactionValue,
            fee: $paymentValueDto->fee,
            totalValue: $paymentValueDto->totalValue,
            paymentMethod: $paymentValueDto->paymentMethod
        );

        return $this->transactionRepository->create($transactionInputCreateDto);
    }
}
