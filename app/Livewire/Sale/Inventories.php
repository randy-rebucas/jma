<?php

namespace App\Livewire\Sale;

use App\Models\Inventory;
use App\Models\Sale;
use LivewireUI\Modal\ModalComponent;

class Inventories extends ModalComponent
{
    // public Inventory $inventory;
    public $inventory;

    public function mount(Sale $sale)
    {
        $this->inventory = Inventory::firstWhere('serial', $sale->serial)->first();
    }
    public function render()
    {
        return view('livewire.sale.inventories');
    }
}
