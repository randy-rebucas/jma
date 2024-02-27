<?php

namespace App\Models;

use App\Casts\Json;
use App\Observers\SaleItemObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([SaleItemObserver::class])]
class SaleItem extends Model
{
    use HasFactory;
    protected $casts = [
        'items' => Json::class,
    ];
    protected $fillable = [
        'items',
        'sale_id',
        'total_amount'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
