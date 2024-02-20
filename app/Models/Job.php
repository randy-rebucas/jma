<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\Json;

class Job extends Model
{
    use HasFactory;

    protected $casts = [
        'scope_of_works' => Json::class,
    ];
    protected $fillable = [
        'scope_of_works',
        'sale_id',
        'type',
        'total_amount'
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
