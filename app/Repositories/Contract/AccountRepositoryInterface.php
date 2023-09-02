<?php

namespace App\Repositories\Contract;

use App\Dto\AccountWalletCreateInputDto;
use App\Entities\AccountEntity;

interface AccountRepositoryInterface
{
    public function create(AccountWalletCreateInputDto $accountCreateDto): AccountEntity;
    public function getById(int $id);
}
