<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    use HasFactory;
    protected $casts = [
        'items' => 'array',
    ];
    protected $fillable = [
        'items',
        'sale_id',
        'sale_total_amount'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
