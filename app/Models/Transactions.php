<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_id',
        'fee',
        'total_value',
        'transaction_value',
        'payment_method'
    ];
    protected $table = 'transactions';
    public $timestamps = true;
}
