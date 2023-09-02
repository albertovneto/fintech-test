<?php

namespace App\Services;


use App\Dto\{
    AccountWalletCreateInputDto,
    AccountWalletCreateOutputDto
};

class AccountWalletCreateService
{
    public function __construct(
        private AccountService $accountService,
        private WalletService $walletService
    ) {
    }

    public function execute(AccountWalletCreateInputDto $accountWalletCreateDto): AccountWalletCreateOutputDto
    {
        $account = $this->accountService->create($accountWalletCreateDto);
        $accountWalletCreateDto->setAccountId($account->id);

        $wallet = $this->walletService->create($accountWalletCreateDto);

        return new AccountWalletCreateOutputDto($wallet->balance, $account->id);
    }
}
