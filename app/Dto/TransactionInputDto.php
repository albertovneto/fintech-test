<?php

namespace App\Dto;

use App\Traits\MethodsMagicsTrait;

class TransactionInputDto
{
    use MethodsMagicsTrait;

    public function __construct(
        protected int $accountId,
        protected string $paymentMethod,
        protected float $transactionValue,
        protected ?float $balance = null,
        protected ?float $fee = 0,
        protected ?float $totalValue = 0,
    ) {
    }

    public function setBalance(float $balance): TransactionInputDto
    {
        $this->balance = $balance;
        return $this;
    }
}
