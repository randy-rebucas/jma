<?php

namespace App\Livewire\Inventory;

use App\Models\Inventory;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{

    use WithPagination;

    public $search;

    public function delete($id): void
    {
        $item = Inventory::find($id);
        $item->delete();

        $this->dispatch('item-deleted');
    }
    public function render()
    {
        $items = DB::table('inventories')
            ->join('sales', 'inventories.serial', '=', 'sales.serial')
            ->select('inventories.*', 'sales.customer_id')
            ->paginate(10);
        return view('livewire.inventory.index', compact('items'));
    }
}
