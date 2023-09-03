<?php

namespace App\Services\Transaction;

use App\Dto\TransactionInputDto;
use App\Exceptions\NotFoundException;

class Pix extends PaymentMethodAbstract implements Transaction
{
    protected $paymentFee = 0;
}
