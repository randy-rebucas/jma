<?php

namespace App\Models;

use App\Observers\JobObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use App\Casts\Json;

#[ObservedBy([JobObserver::class])]
class Job extends Model
{
    use HasFactory;

    protected $casts = [
        'paid' => 'boolean',
    ];

    protected $fillable = [
        'job_type',
        'user_id',
        'customer_id',
        'total_amount',
        'paid',
        'car_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function job_payment()
    {
        return $this->hasOne(JobPayment::class);
    }

    public function job_items()
    {
        return $this->hasMany(JobItem::class);
    }

    public function job_scope_of_works()
    {
        return $this->hasMany(JobScopeOfWorks::class);
    }

    public function car()
    {
        return $this->hasOne(Car::class);
    }
}
