<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class CustomerCar extends Model
{
    use Searchable;

    use HasFactory;
    protected $touches = ['car', 'customer'];

    protected $fillable = [
        'car_id',
        'customer_id'
    ];

    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function toSearchableArray()
    {
        return [
            'first_name' => $this->customer->first_name,
            'last_name' => $this->customer->last_name,
            'brand' => $this->car->brand,
            'plate_number' => $this->car->plate_number,
            'engine_number' => $this->car->engine_number,
            'chassis_number' => $this->car->chassis_number
        ];
    }
    public function searchableAs(): string
    {
        return 'customer_cars_index';
    }
}
