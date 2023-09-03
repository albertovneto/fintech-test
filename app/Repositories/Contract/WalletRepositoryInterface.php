<?php

namespace App\Repositories\Contract;

use App\Dto\{
    AccountWalletCreateInputDto,
    WalletUpdateInputDto
};
use App\Entities\WalletEntity;

interface WalletRepositoryInterface
{
    public function create(AccountWalletCreateInputDto $accountWalletCreateDto): WalletEntity;
    public function update(WalletUpdateInputDto $walletUpdateInputDto): WalletEntity;
}
