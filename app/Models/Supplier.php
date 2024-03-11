<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
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
        'company_name',
        'comments',
        'user_id'
    ];
    protected $appends = [
        'full_name'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function items() 
    {
        return $this->hasMany(Item::class);
    }
    public function getFullNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }
}
