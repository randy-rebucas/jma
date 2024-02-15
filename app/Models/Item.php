<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'code',
        'item_number',
        'description',
        'cost_price',
        'unit_price',
        'reorder_level',
        'receiving_quantity',
        'category_id',
        'supplier_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function sale_item()
    {
        return $this->hasOne(SaleItem::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
