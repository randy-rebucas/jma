<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobScopeOfWorks extends Model
{
    use HasFactory;

    // protected $casts = [
    //     'scopes' => Json::class,
    // ];
    protected $fillable = [
        'job_id',
        'quantity',
        'unit_price',
        'sub_total',
        'name'
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
