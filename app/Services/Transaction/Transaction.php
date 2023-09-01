<?php

namespace App\Services\Transaction;

interface Transaction
{
    public function transfer();
    public function payment();
    public function calcFee(float $value);
    public function total();
}
