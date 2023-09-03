<?php

namespace App\Repositories;

use App\Dto\AccountWalletCreateInputDto;
use App\Dto\WalletUpdateInputDto;
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

        return new WalletEntity(
            accountId: $created->account_id,
            id: $created->id,
            balance: $created->balance
        );
    }

    public function update(WalletUpdateInputDto $walletUpdateInputDto): WalletEntity
    {
        $wallet = $this->model->find($walletUpdateInputDto->id);
        $wallet->balance = $walletUpdateInputDto->balance;
        $wallet->save();

        return new WalletEntity(
            accountId: $walletUpdateInputDto->accountId,
            id: $walletUpdateInputDto->id,
            balance: $walletUpdateInputDto->balance
        );
    }
}
