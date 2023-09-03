<?php

namespace App\Services\Transaction;

class Debit extends PaymentMethodAbstract implements Transaction
{
    protected $paymentFee = 3;
}
