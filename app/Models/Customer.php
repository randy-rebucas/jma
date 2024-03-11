<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
class Customer extends Model
{
    use Searchable;
    use HasFactory;
    use SoftDeletes;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'user_id'
    ];

    protected $appends = [
        'full_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function jobs() 
    {
        return $this->hasMany(Job::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    public function customer_cars()
    {
        return $this->hasMany(CustomerCar::class);
    }

    public function addresses()
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function searchableAs() : string 
    {
        return 'customer_index';
    }
    public static function getCustomerName($id)
    {
        return self::with('user')->find($id)->full_name;
    }
}
