<?php

namespace App\Services\Transaction;

use App\Dto\TransactionInputDto;
use App\Dto\WalletUpdateInputDto;
use App\Models\Account;
use App\Models\Wallet;
use App\Services\AccountService;
use App\Services\WalletService;

class TransactionService
{
    public function __construct(
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
            balance: $this->walletService->balanceDiscount($accountData->wallet->balance, $paymentValue)
        );

        $update = $this->walletService->update($walletUpdateInputDto);

        dd($update);
    }
}
