<?php

namespace App\Models;

use App\Observers\ReceivingPaymentObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([ReceivingPaymentObserver::class])]
class ReceivingPayment extends Model
{
    use HasFactory;
    protected $fillable = [
        'payment_type',
        'payment_amount',
        'receiving_id'
    ];

    public function receiving()
    {
        return $this->belongsTo(Receiving::class);
    }
}
