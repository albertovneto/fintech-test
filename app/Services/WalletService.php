<?php

namespace App\Services;

use App\Dto\AccountWalletCreateInputDto;
use App\Entities\WalletEntity;
use App\Repositories\Contract\WalletRepositoryInterface;

class WalletService
{
    public function __construct(
        private WalletRepositoryInterface $walletRepository,
    ) {
    }

    public function create(AccountWalletCreateInputDto $accountCreateDto): WalletEntity
    {
        return $this->walletRepository->create($accountCreateDto);
    }
}
