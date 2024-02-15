<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'serial_number',
        'quantity_purchased',
        'cost_price',
        'unit_price',
        'discount',
        'print_option',
        'sale_id',
        'item_id'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
