<?php

namespace App\Services\Transaction\PaymentMethods;

use App\Enums\PaymentMethodsEnum;

class Debit extends PaymentMethodAbstract implements PaymentMethodInterface
{
    protected int $paymentFee = 3;
    protected string $paymentMethod = PaymentMethodsEnum::DEBIT;
}
