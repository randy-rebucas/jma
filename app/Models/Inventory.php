<?php

namespace App\Models;

use App\Casts\Json;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $casts = [
        'items' => Json::class,
    ];
    protected $fillable = [
        'transaction_type',
        'transaction_total_amount',
        'user_id',
        'transaction_code',
        'transaction_paid_amount',
        'transaction_payment_method',
        'items',
        'serial'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function getCustomer($serial)
    {
        $trx = self::where('serial', $serial)->first();
        if ($trx->transaction_type == 'sale') {
            $sale = Sale::with('customer')->where('serial', $serial)->first();
            return $sale->customer->full_name;
        }
        if ($trx->transaction_type == 'order' || $trx->transaction_type == 'estimate') {
            $job = Job::with('customer')->where('serial', $serial)->first();
            return $job->customer->full_name;
        }
        if ($trx->transaction_type == 'receive') {
            $receiving = Receiving::with('supplier')->where('serial', $serial)->first();
            return $receiving->supplier->full_name;
        }
        return null;
    }
}
