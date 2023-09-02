<?php

namespace App\Services;

use App\Dto\AccountWalletCreateInputDto;
use App\Entities\AccountEntity;
use App\Repositories\Contract\{AccountRepositoryInterface};

class AccountService
{
    public function __construct(
        private AccountRepositoryInterface $accountRepository,
    ) {
    }

    public function create(AccountWalletCreateInputDto $accountCreateDto): AccountEntity
    {
        return $this->accountRepository->create($accountCreateDto);
    }

    public function getByAccountId(int $id): AccountEntity
    {
        return $this->accountRepository->getById($id);
    }
}
