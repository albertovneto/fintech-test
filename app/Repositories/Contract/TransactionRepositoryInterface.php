<?php

namespace App\Repositories\Contract;

interface TransactionRepositoryInterface
{
    public function create($transactionCreateDto);
}
