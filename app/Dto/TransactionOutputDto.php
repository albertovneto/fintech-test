<?php

namespace App\Dto;

use App\Traits\MethodsMagicsTrait;

class TransactionOutputDto
{
    use MethodsMagicsTrait;

    public function __construct(
        protected int $accountId,
        protected float $balance,
    ) {
    }

    public function toArray(): array
    {
        return [
          'account_id' => $this->accountId,
          'balance' => $this->balance
        ];
    }
}
