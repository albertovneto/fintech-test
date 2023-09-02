<?php

namespace App\Repositories;

use App\Dto\AccountWalletCreateInputDto;
use App\Entities\{
    AccountEntity,
    WalletEntity
};
use App\Exceptions\NotFoundException;
use App\Models\Account;
use App\Repositories\Contract\AccountRepositoryInterface;

class AccountRepository implements AccountRepositoryInterface
{
    public function __construct(
        private Account $model
    ) {
    }

    public function create(AccountWalletCreateInputDto $accountCreateDto): AccountEntity
    {
        $created = $this->model->create($accountCreateDto->toArray());
        return new AccountEntity($created->id, $created->cpf);
    }

    public function getById(int $id): AccountEntity
    {
        $account = $this->model->where('account.id', $id)
            ->join('wallet', 'wallet.account_id', '=', 'account.id')
            ->select(['wallet.id as wallet_id', 'wallet.balance', 'account.*'])
            ->first();

        if (empty($account)) {
            throw new NotFoundException();
        }

        $wallet = new WalletEntity($account->wallet_id, $account->balance);
        return new AccountEntity($account->id, $account->cpf, $wallet);
    }
}
