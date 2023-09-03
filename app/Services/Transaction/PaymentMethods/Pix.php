<?php

namespace App\Services\Transaction\PaymentMethods;

use App\Enums\PaymentMethodsEnum;

class Pix extends PaymentMethodAbstract implements PaymentMethodInterface
{
    protected int $paymentFee = 0;
    protected string $paymentMethod = PaymentMethodsEnum::PIX;
}
