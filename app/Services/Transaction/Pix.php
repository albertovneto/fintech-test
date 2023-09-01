<?php

namespace App\Services\Transaction;

class Pix implements Transaction
{
    private const PERCENTAGE_FEE = 0;

    public function transfer()
    {
        return true;
    }

    public function payment()
    {

    }

    public function calcFee(float $value)
    {
        return self::PERCENTAGE_FEE;
    }

    public function total()
    {
        return $this->value - $this->calcFee($this->value);
    }
}
