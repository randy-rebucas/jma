<?php

namespace App\Observers;

use App\Enums\SaleType;
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
        $sale = Sale::find($saleItem->sale->id);
        //
        $items = json_decode($saleItem->items, true);

        if ($sale->sale_type == SaleType::Sale) {
            foreach ($items as $key => $item) {
                Item::where('id', $key)->decrement('receiving_quantity', $item["qty"]);
            }
        }

        if ($sale->sale_type == SaleType::Return) {
            foreach ($items as $key => $item) {
                Item::where('id', $key)->increment('receiving_quantity', $item["qty"]);
            }
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
