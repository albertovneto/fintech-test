<?php

namespace App\Dto;

use App\Traits\MethodsMagicsTrait;

class AccountWalletCreateOutputDto
{
    use MethodsMagicsTrait;

    public function __construct(
        protected float $balance = 0,
        protected ?int $accountId = null
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->accountId,
            'balance' => $this->balance,
        ];
    }
}
