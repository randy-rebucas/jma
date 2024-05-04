<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'part_number',
        'cost_price',
        'unit_price',
        'selling_price',
        'reorder_level',
        'receiving_quantity',
        'category_id',
        'supplier_id'
    ];

    protected $appends = [
        'format_unit_price',
        'format_cost_price',
        'format_selling_price'
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

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function getFormatCostPriceAttribute()
    {
       return  number_format($this->cost_price, 2);
    }

    public function getFormatUnitPriceAttribute()
    {
       return  number_format($this->unit_price, 2);
    }

    public function getFormatSellingPriceAttribute()
    {
       return  number_format($this->selling_price, 2);
    }
}
