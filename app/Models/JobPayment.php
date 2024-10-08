<?php

namespace App\Models;

use App\Observers\JobPaymentObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([JobPaymentObserver::class])]
class JobPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_type',
        'tendered_amount',
        'change',
        'discount',
        'job_id'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
    
}
