<?php

namespace App\Services\Transaction\PaymentMethods;

use App\Enums\PaymentMethodsEnum;

class Credit extends PaymentMethodAbstract implements PaymentMethodInterface
{
    protected int $paymentFee = 5;
    protected string $paymentMethod = PaymentMethodsEnum::CREDIT;
}
