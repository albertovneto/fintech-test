<?php

namespace App\Services\Transaction\PaymentMethods;

use App\Dto\PaymentValueDto;
use App\Dto\TransactionInputDto;

interface PaymentMethodInterface
{
    public function paymentValue(TransactionInputDto $transactionInputDto): PaymentValueDto;
}
