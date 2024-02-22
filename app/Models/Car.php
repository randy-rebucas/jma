<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'brand',
        'plate_number',
        'model',
        'color',
        'odo_km',
        'engine_number',
        'chassis_number',
        'year'
    ];

    public function customer_car()
    {
        return $this->belongsTo(CustomerCar::class);
    }
}
