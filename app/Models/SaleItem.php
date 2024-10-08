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

    public $timestamps = false;

    // protected $casts = [
    //     'items' => Json::class,
    // ];

    protected $fillable = [
        'sale_id',
        'quantity',
        'unit_price',
        'sub_total',
        'item_id'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
