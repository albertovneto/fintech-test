<?php

namespace App\Entities;

use App\Traits\MethodsMagicsTrait;

class WalletEntity
{
    use MethodsMagicsTrait;

    public function __construct(
        protected int $accountId,
        protected ?int $id = null,
        protected float $balance = 0,
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'account_id' => $this->accountId,
            'balance' => $this->balance
        ];
    }
}
