<?php

namespace App\Repositories;

use App\Dto\AccountWalletCreateInputDto;
use App\Entities\WalletEntity;
use App\Models\Wallet;
use App\Repositories\Contract\WalletRepositoryInterface;

class WalletRepository implements WalletRepositoryInterface
{
    public function __construct(
        private Wallet $model
    ) {
    }

    public function create(AccountWalletCreateInputDto $accountWalletCreateDto): WalletEntity
    {
        $created = $this->model->create($accountWalletCreateDto->toArray());
        return new WalletEntity($created->id, $created->balance);
    }
}
