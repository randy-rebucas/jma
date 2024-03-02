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
        'price',
        'reorder_level',
        'receiving_quantity',
        'category_id',
        'supplier_id'
    ];

    protected $appends = [
        'format_price',
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

    public function getFormatPriceAttribute()
    {
       return  number_format($this->price, 2);
    }
}
