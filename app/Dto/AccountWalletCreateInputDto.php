<?php

namespace App\Dto;

use App\Traits\MethodsMagicsTrait;

class AccountWalletCreateInputDto
{
    use MethodsMagicsTrait;

    public function __construct(
        protected float $balance = 0,
        protected ?string $cpf = null,
        protected ?int $accountId = null
    ) {
    }

    public function setAccountId(int $accountId): void
    {
        $this->accountId = $accountId;
    }

    public function toArray(): array
    {
        return [
            'balance' => $this->balance,
            'cpf' => $this->cpf,
            'account_id' => $this->accountId,
        ];
    }
}
