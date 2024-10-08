<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Car extends Model
{
    use Searchable;
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

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function searchableAs() : string 
    {
        return 'cars_index';
    }
}
