<?php

namespace App\Models;

use App\Casts\Json;
use App\Observers\JobItemObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([JobItemObserver::class])]
class JobItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'quantity',
        'unit_price',
        'sub_total',
        'item_id'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
