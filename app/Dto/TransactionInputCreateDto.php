<?php

namespace App\Dto;

use App\Traits\MethodsMagicsTrait;

class TransactionInputCreateDto
{
    use MethodsMagicsTrait;

    public function __construct(
        protected int $accountId,
        protected float $transactionValue,
        protected float $fee,
        protected float $totalValue,
        protected string $paymentMethod
    ) {
    }

    public function toArray(): array
    {
        return [
            'account_id' => $this->accountId,
            'transaction_value' => $this->transactionValue,
            'fee' => $this->fee,
            'total_value' => $this->totalValue,
            'payment_method' => $this->paymentMethod
        ];
    }
}
