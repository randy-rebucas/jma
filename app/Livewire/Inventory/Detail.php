<?php

namespace App\Livewire\Inventory;

use App\Models\Inventory;
use App\Models\Sale;
use LivewireUI\Modal\ModalComponent;

class Detail extends ModalComponent
{
    public $inventory;

    public function mount(Sale $sale)
    {
        $this->inventory = Inventory::firstWhere('serial', $sale->serial)->first();
    }
    public function render()
    {
        return view('livewire.inventory.detail');
    }
}
