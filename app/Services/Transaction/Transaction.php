<?php

namespace App\Services\Transaction;

use App\Dto\TransactionInputDto;

interface Transaction
{
    public function paymentValue(TransactionInputDto $transactionInputDto);
}
