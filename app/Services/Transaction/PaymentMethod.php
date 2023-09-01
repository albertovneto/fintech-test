<?php

namespace App\Services\Transaction;

class PaymentMethod
{
    public function method($paymentMethod)
    {
        switch ($paymentMethod) {
            case 'P':
                return new Pix();
            case 'C':
                return new Credit();
            case 'D':
                return new Debit();
        }
    }
}
