<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Job extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_number',
        'type',
        'customer_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function customerName() {
        return Attribute::make(
            get: fn () => $this->customer->first_name.' '.$this->customer->last_name,
        );
    }
}
