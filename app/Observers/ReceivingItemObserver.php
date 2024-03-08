<?php

namespace App\Observers;

use App\Enums\ReceivingTypeEnum;
use App\Models\Item;
use App\Models\Receiving;
use App\Models\ReceivingItem;

class ReceivingItemObserver
{
    /**
     * Handle the ReceivingItem "created" event.
     */
    public function created(ReceivingItem $receivingItem): void
    {
        $receiving = Receiving::find($receivingItem->receiving->id);

        if ($receiving->receiving_type == ReceivingTypeEnum::RECEIVE) {
            Item::where('id', $receivingItem->item_id)->decrement('receiving_quantity', $receivingItem->quantity);
        }

        if ($receiving->receiving_type == ReceivingTypeEnum::RETURN) {
            Item::where('id', $receivingItem->item_id)->increment('receiving_quantity', $receivingItem->quantity);
        }
    }

    /**
     * Handle the ReceivingItem "updated" event.
     */
    public function updated(ReceivingItem $receivingItem): void
    {
        //
    }

    /**
     * Handle the ReceivingItem "deleted" event.
     */
    public function deleted(ReceivingItem $receivingItem): void
    {
        //
    }

    /**
     * Handle the ReceivingItem "restored" event.
     */
    public function restored(ReceivingItem $receivingItem): void
    {
        //
    }

    /**
     * Handle the ReceivingItem "force deleted" event.
     */
    public function forceDeleted(ReceivingItem $receivingItem): void
    {
        //
    }
}
