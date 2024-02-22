<?php

namespace App\Livewire\Supplier;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]
class DetailSupplier extends Component
{
    public Supplier $supplier;

    public function mount($supplierId)
    {
        $this->supplier = Supplier::with('items')->findOrFail($supplierId);
    }

    public function render()
    {
        return view('livewire.supplier.detail-supplier');
    }
}
