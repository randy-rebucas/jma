<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'line_1',
        'line_2',
        'district',
        'city_id',
        'postal_code'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function customer_address()
    {
        return $this->belongsTo(CustomerAddress::class);
    }
}
