<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;
    protected $fillable = ['balance', 'account_id'];
    protected $table = 'wallet';
    protected $primaryKey = 'id';
}
