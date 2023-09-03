<?php

namespace App\Services\Transaction;

use App\Enums\PaymentMethodsEnum;
use App\Exceptions\NotFoundException;
use App\Services\Transaction\PaymentMethods\Credit;
use App\Services\Transaction\PaymentMethods\Debit;
use App\Services\Transaction\PaymentMethods\Pix;

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
