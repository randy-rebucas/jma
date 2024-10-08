<?php

namespace App\Models;

use App\Casts\Json;
use App\Observers\ReceivingItemObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([ReceivingItemObserver::class])]
class ReceivingItem extends Model
{
    use HasFactory;

    protected $casts = [
        'items' => Json::class,
    ];
    protected $fillable = [
        'items',
        'receiving_id',
        'total_amount'
    ];

    public function receiving()
    {
        return $this->belongsTo(Receiving::class);
    }
}
