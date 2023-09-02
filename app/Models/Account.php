<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Account extends Model
{
    use HasFactory;
    protected $fillable = ['cpf'];
    protected $table = 'account';
    public $timestamps = true;

    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }
}
