<?php

namespace App\Livewire\Pos;

use Livewire\Component;
use App\Models\Supplier;
use Livewire\Attributes\On;
class ScanSupplier extends Component
{
    public $types = [];
    public $search;
    public $records;
    public $details;
    public $supplierId;

    public function searchResult()
    {
        $this->records = Supplier::orderby('first_name', 'asc')
            ->select('*')
            ->where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->take(5)
            ->get();
    }
    public function setSupplier($id)
    {
        $record = Supplier::select('*')
            ->where('id', $id)
            ->first();

        $this->details = $record;

        $this->supplierId = $id;
        $this->records = [];
        $this->search = '';

        $this->dispatch('setSupplier', supplierId: $id);
    }

    #[On('saleCompleted')]
    public function clearSupplierId() {
        $this->details = null;
        $this->records = [];
        $this->search = '';
    }
    public function mount(): void
    {
        if ($this->supplierId) {
            $this->setSupplier($this->supplierId);
        }
    }
    public function render()
    {
        return view('livewire.pos.scan-supplier');
    }
}
