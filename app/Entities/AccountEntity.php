<?php

namespace App\Entities;

use App\Traits\MethodsMagicsTrait;

class AccountEntity
{
    use MethodsMagicsTrait;

    public function __construct(
        protected ?int $id = null,
        protected ?string $cpf = null,
        protected ?WalletEntity $wallet = null
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'balance' => $this->wallet?->balance
        ];
    }
}
