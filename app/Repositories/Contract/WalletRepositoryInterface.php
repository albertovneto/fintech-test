<?php

namespace App\Repositories\Contract;

use App\Dto\AccountWalletCreateInputDto;

interface WalletRepositoryInterface
{
    public function create(AccountWalletCreateInputDto $accountWalletCreateDto);
}
