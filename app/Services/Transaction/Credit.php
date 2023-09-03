<?php

namespace App\Services\Transaction;

class Credit extends PaymentMethodAbstract implements Transaction
{
    protected $paymentFee = 5;
}
