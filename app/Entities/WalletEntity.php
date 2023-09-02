<?php

namespace App\Entities;

use App\Traits\MethodsMagicsTrait;

class WalletEntity
{
    use MethodsMagicsTrait;

    public function __construct(
        protected ?int $id = null,
        protected float $balance = 0
    ) {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'cpf' => $this->cpf
        ];
    }
}
