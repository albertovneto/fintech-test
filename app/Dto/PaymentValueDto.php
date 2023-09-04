<?php

namespace App\Dto;

use App\Traits\MethodsMagicsTrait;

class PaymentValueDto
{
    use MethodsMagicsTrait;

    public function __construct(
        protected float $transactionValue,
        protected float $fee,
        protected float $totalValue,
        protected string $paymentMethod
    ) {
    }
}
