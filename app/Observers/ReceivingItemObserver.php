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
        //
        $items = json_decode($receivingItem->items, true);

        if ($receiving->receiving_type == ReceivingTypeEnum::RECEIVE) {
            foreach ($items as $item) {
                Item::where('id', $item['id'])->increment('receiving_quantity', $item["qty"]);
            }
        }

        if ($receiving->receiving_type == ReceivingTypeEnum::RETURN) {
            foreach ($items as $item) {
                Item::where('id', $item['id'])->decrement('receiving_quantity', $item["qty"]);
            }
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
