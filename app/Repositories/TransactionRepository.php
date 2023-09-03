<?php

namespace App\Repositories;

use App\Dto\TransactionInputCreateDto;
use App\Entities\AccountEntity;
use App\Entities\TransactionEntity;
use App\Models\Transactions;
use App\Repositories\Contract\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function __construct(
        private Transactions $model
    ) {
    }

    public function create(TransactionInputCreateDto $transactionInputCreateDto): TransactionEntity
    {
        $created = $this->model->create($transactionInputCreateDto->toArray());

        return new TransactionEntity(
            $created->id,
            $created->account_id,
            $created->transaction_value,
            $created->fee,
            $created->total_value,
            $created->payment_method
        );
    }
}
