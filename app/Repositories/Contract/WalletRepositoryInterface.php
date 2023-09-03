<?php

namespace App\Repositories\Contract;

use App\Dto\AccountWalletCreateInputDto;
use App\Dto\WalletUpdateInputDto;

interface WalletRepositoryInterface
{
    public function create(AccountWalletCreateInputDto $accountWalletCreateDto);
    public function update(WalletUpdateInputDto $walletUpdateInputDto);
}
