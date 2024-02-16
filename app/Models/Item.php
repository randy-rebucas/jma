<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

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

    protected $appends = [
        'format_cost_price',
        'format_unit_price'
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

    public function getFormatUnitPriceAttribute()
    {
        return number_format($this->unit_price, 2);
    }

    public function getFormatCostPriceAttribute()
    {
        return number_format($this->cost_price, 2);
    }
}
