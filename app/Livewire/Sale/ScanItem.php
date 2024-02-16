<?php

namespace App\Livewire\Sale;

use App\Models\Item;
use Livewire\Component;
use App\Facades\Cart;

class ScanItem extends Component
{
    public $hasSelected = false;
    public $search;
    public $records;

    public Item $item;
    // Fetch records
    public function searchResult()
    {
        $this->records = Item::orderby('name', 'asc')
            ->select('*')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('item_number', 'like', '%' . $this->search . '%')
            ->orWhere('code', 'like', '%' . $this->search . '%')
            ->take(5)
            ->get();
    }

    public function setItem($id = 0)
    {

        $this->item = Item::findOrFail($id);

        Cart::add($this->item->id, $this->item->name, $this->item->getRawOriginal('unit_price'), 1);

        $this->dispatch('addItem', $id);
        $this->records = [];
        $this->search = '';
    }

    public function render()
    {
        return view('livewire.sale.scan-item');
    }
}
