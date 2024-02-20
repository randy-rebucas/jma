<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_type',
        'transaction_total_amount',
        'user_id',
        'transaction_code',
        'transaction_paid_amount',
        'transaction_payment_method',
        'items',
        'serial'
    ];
}
