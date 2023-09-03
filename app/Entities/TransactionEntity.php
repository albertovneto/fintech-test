<?php

namespace App\Entities;

use App\Traits\MethodsMagicsTrait;

class TransactionEntity
{
    use MethodsMagicsTrait;

    public function __construct(
        protected int $id,
        protected int $accountId,
        protected float $transactionValue,
        protected int $fee,
        protected float $totalValue,
        protected string $paymentMethod
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'account_id' => $this->accountId,
            'transaction_value' => $this->transactionValue,
            'fee' => $this->fee,
            'total_value' => $this->totalValue,
            'payment_method' => $this->paymentMethod
        ];
    }
}
