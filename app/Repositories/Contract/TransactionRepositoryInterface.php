<?php

namespace App\Repositories\Contract;

use App\Dto\TransactionInputCreateDto;

interface TransactionRepositoryInterface
{
    public function create(TransactionInputCreateDto $transactionInputCreateDto);
}
