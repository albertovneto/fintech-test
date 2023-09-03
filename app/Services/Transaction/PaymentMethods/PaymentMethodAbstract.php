<?php

namespace App\Services\Transaction\PaymentMethods;

use App\Dto\PaymentValueDto;
use App\Dto\TransactionInputDto;
use App\Exceptions\NotFoundException;

abstract class PaymentMethodAbstract implements PaymentMethodInterface
{
    protected int $paymentFee = 0;
    protected string $paymentMethod = '';

    public function paymentValue(TransactionInputDto $transactionInputDto): PaymentValueDto
    {
        $transactionValue = $transactionInputDto->transactionValue;
        $feeValue = $this->calcFee($transactionValue);
        $totalValue = $this->total($transactionValue, $feeValue);

        if ($totalValue > $transactionInputDto->balance) {
            throw new NotFoundException('Your account has no available balance');
        }

        return new PaymentValueDto(
            transactionValue: $transactionValue,
            fee: $feeValue,
            totalValue: $totalValue,
            paymentMethod: $this->paymentMethod
        );
    }

    private function calcFee(float $value): float
    {
        if (empty($this->paymentFee)) {
            return 0;
        }

        return round(($value * $this->paymentFee) / 100, 2);
    }

    private function total(float $transactionValue, float $feeValue): float
    {
        return round($transactionValue + $feeValue, 2);
    }
}
