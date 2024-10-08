<?php

namespace App\Observers;

use App\Enums\SaleTypeEnum;
use App\Models\Item;
use App\Models\Sale;
use App\Models\SaleItem;

class SaleItemObserver
{
    /**
     * Handle the SaleItem "created" event.
     */
    public function created(SaleItem $saleItem): void
    {
        // get the type
        $sale = Sale::find($saleItem->sale->id);

        if ($sale->sale_type == SaleTypeEnum::SALE) {
            Item::where('id', $saleItem->item_id)->decrement('receiving_quantity', $saleItem->quantity);
        }

        if ($sale->sale_type == SaleTypeEnum::RETURN ) {
            Item::where('id', $saleItem->item_id)->increment('receiving_quantity', $saleItem->quantity);
        }
    }

    /**
     * Handle the SaleItem "updated" event.
     */
    public function updated(SaleItem $saleItem): void
    {
        //
    }

    /**
     * Handle the SaleItem "deleted" event.
     */
    public function deleted(SaleItem $saleItem): void
    {
        //
    }

    /**
     * Handle the SaleItem "restored" event.
     */
    public function restored(SaleItem $saleItem): void
    {
        //
    }

    /**
     * Handle the SaleItem "force deleted" event.
     */
    public function forceDeleted(SaleItem $saleItem): void
    {
        //
    }
}
