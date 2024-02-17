<?php

namespace App\Observers;

use App\Models\Inventory;
use App\Models\Sale;
use App\Models\SalePayment;
use Illuminate\Support\Str;
class SalePaymentObserver
{
    /**
     * Handle the SalePayment "created" event.
     */
    public function created(SalePayment $salePayment): void
    {
        $sale = Sale::find($salePayment->sale->id);

        Inventory::create([
            "transaction_code" => Str::uuid(),
            "transaction_type" => $sale->sale_type,
            "user_id" => $sale->user->id,
            "transaction_paid_amount" => $sale->sale_payment->payment_amount,
            "transaction_payment_method" => $sale->sale_payment->payment_type,
            "transaction_total_amount" => $sale->sale_item->sale_total_amount,
            "items" => $sale->sale_item->items
        ]);
    }

    /**
     * Handle the SalePayment "updated" event.
     */
    public function updated(SalePayment $salePayment): void
    {
        //
    }

    /**
     * Handle the SalePayment "deleted" event.
     */
    public function deleted(SalePayment $salePayment): void
    {
        //
    }

    /**
     * Handle the SalePayment "restored" event.
     */
    public function restored(SalePayment $salePayment): void
    {
        //
    }

    /**
     * Handle the SalePayment "force deleted" event.
     */
    public function forceDeleted(SalePayment $salePayment): void
    {
        //
    }
}
