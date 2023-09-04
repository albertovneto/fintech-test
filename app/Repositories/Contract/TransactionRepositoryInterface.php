<?php

namespace App\Repositories\Contract;

use App\Dto\TransactionInputCreateDto;
use App\Entities\TransactionEntity;

interface TransactionRepositoryInterface
{
    public function create(TransactionInputCreateDto $transactionInputCreateDto): TransactionEntity;
}
