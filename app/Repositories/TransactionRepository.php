<?php

namespace App\Repositories;

use App\Entities\AccountEntity;
use App\Models\Transactions;
use App\Repositories\Contract\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function __construct(
        private Transactions $model
    ) {
    }

    public function create($transactionCreateDto)
    {
        $created = $this->model->create($transactionCreateDto->toArray());
        return new AccountEntity($created->id, $created->cpf);
    }
}
