<?php

namespace App\Services\Transaction;

class Debit implements Transaction
{
    private const PERCENTAGE_FEE = 3;

    public function transfer()
    {
        return true;
    }

    public function payment()
    {

    }

    public function calcFee(float $value)
    {
        return ($value * self::PERCENTAGE_FEE) / 100;
    }

    public function total()
    {
        return $this->value - $this->calcFee($this->value);
    }
}
