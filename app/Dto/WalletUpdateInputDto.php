<?php

namespace App\Dto;

use App\Traits\MethodsMagicsTrait;

class WalletUpdateInputDto
{
    use MethodsMagicsTrait;

    public function __construct(
        protected int $id,
        protected int $accountId,
        protected float $balance = 0,
    ) {
    }
}
