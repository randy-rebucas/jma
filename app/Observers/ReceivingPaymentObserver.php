<?php

namespace App\Observers;

use App\Models\Inventory;
use App\Models\Receiving;
use App\Models\ReceivingPayment;
use Illuminate\Support\Str;

class ReceivingPaymentObserver
{
    /**
     * Handle the ReceivingPayment "created" event.
     */
    public function created(ReceivingPayment $receivingPayment): void
    {
        // $receiving = Receiving::find($receivingPayment->receiving->id);

        // Inventory::create([
        //     "transaction_code" => Str::uuid(),
        //     "transaction_type" => $receiving->receiving_type,
        //     "user_id" => $receiving->user->id,
        //     "transaction_paid_amount" => $receiving->receiving_payment->payment_amount,
        //     "transaction_payment_method" => $receiving->receiving_payment->payment_type,
        //     "transaction_total_amount" => $receiving->receiving_item->total_amount,
        //     "items" => $receiving->receiving_item->items,
        //     "serial" => $receiving->serial
        // ]);
    }

    /**
     * Handle the ReceivingPayment "updated" event.
     */
    public function updated(ReceivingPayment $receivingPayment): void
    {
        //
    }

    /**
     * Handle the ReceivingPayment "deleted" event.
     */
    public function deleted(ReceivingPayment $receivingPayment): void
    {
        //
    }

    /**
     * Handle the ReceivingPayment "restored" event.
     */
    public function restored(ReceivingPayment $receivingPayment): void
    {
        //
    }

    /**
     * Handle the ReceivingPayment "force deleted" event.
     */
    public function forceDeleted(ReceivingPayment $receivingPayment): void
    {
        //
    }
}
