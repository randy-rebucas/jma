<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalePayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_type',
        'payment_amount',
        'sale_id'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
