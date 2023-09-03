<?php

namespace App\Services;

use App\Dto\AccountWalletCreateInputDto;
use App\Dto\WalletUpdateInputDto;
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

    public function update(WalletUpdateInputDto $walletUpdateInputDto): WalletEntity
    {
        return $this->walletRepository->update($walletUpdateInputDto);
    }

    public function balanceDiscount(float $balance, float $valueToDiscount): float
    {
        return round($balance - $valueToDiscount, 2);
    }
}
