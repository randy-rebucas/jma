<?php

namespace App\Models;

use App\Enums\PaymentMethodEnum;
use App\Observers\SalePaymentObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([SalePaymentObserver::class])]
class SalePayment extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $casts = [
        'payment_type' => PaymentMethodEnum::class, // Example enum cast
    ];
    
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
