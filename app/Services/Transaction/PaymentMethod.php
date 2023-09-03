<?php

namespace App\Services\Transaction;

use App\Enums\PaymentMethodsEnum;
use App\Exceptions\NotFoundException;

class PaymentMethod
{
    public function method($paymentMethod)
    {
        switch ($paymentMethod) {
            case PaymentMethodsEnum::PIX:
                return new Pix();
            case PaymentMethodsEnum::CREDIT:
                return new Credit();
            case PaymentMethodsEnum::DEBIT:
                return new Debit();
        }

        throw new NotFoundException('Payment method Not Found');
    }
}
