<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiving extends Model
{
    use HasFactory;
    protected $fillable = [
        'receiving_type',
        'serial',
        'user_id',
        'supplier_id'
    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function receiving_payment()
    {
        return $this->hasOne(ReceivingPayment::class);
    }

    public function receiving_item()
    {
        return $this->hasOne(ReceivingItem::class);
    }
}
