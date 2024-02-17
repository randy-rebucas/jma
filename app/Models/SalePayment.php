<?php

namespace App\Models;

use App\Observers\SalePaymentObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([SalePaymentObserver::class])]
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
