<?php

namespace App\Services\Transaction;

use App\Dto\TransactionInputDto;
use App\Exceptions\NotFoundException;

abstract class PaymentMethodAbstract
{
    protected $paymentFee = 0;

    public function paymentValue(TransactionInputDto $transactionInputDto)
    {
        $feeValue = $this->calcFee($transactionInputDto->transactionValue);
        $totalValue = $this->total($transactionInputDto->transactionValue, $feeValue);

        if ($totalValue > $transactionInputDto->balance) {
            throw new NotFoundException('Your account has no available balance');
        }

        return $totalValue;
    }

    private function calcFee(float $value): float
    {
        return round(($value * $this->paymentFee) / 100, 2);
    }

    private function total(float $transactionValue, float $feeValue): float
    {
        return round($transactionValue + $feeValue, 2);
    }
}
