<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\Json;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_type',
        'user_id',
        'customer_id',
        'total_amount'
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

    public function job_item()
    {
        return $this->hasOne(JobItem::class);
    }

    public function job_scope_of_works()
    {
        return $this->hasOne(JobScopeOfWorks::class);
    }
}
