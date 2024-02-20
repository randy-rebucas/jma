<?php

namespace App\Livewire\Sale;

use App\Models\Item;
use Livewire\Component;
use App\Facades\Cart;

class ScanItem extends Component
{
    public $search;
    public $records;

    public Item $item;
    // Fetch records
    public function searchResult()
    {
        if ($this->search) {
            $this->records = Item::orderby('name', 'asc')
                ->select('*')
                ->where('receiving_quantity', '>=', 1)
                ->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('item_number', 'like', '%' . $this->search . '%')
                ->orWhere('code', 'like', '%' . $this->search . '%')
                ->take(5)
                ->get();
        } else {
            $this->records = [];
        }
    }

    public function setItem($id = 0)
    {
        $this->item = Item::findOrFail($id);

        if (is_null(Cart::get($this->item->id))) {
            if ($this->item->receiving_quantity >= 1) {
                Cart::add($this->item->id, $this->item->name, $this->item->getRawOriginal('unit_price'), 1);
                $this->dispatch('addItem');
                $this->records = [];
            }
        } else {
            /**
             * scenario
             * 2 > 1 || 2 == 2
             */
            $newQuantity = $this->item->receiving_quantity - Cart::get($this->item->id)['quantity'];

            if ($this->item->receiving_quantity > $newQuantity && $newQuantity > 0) {
                Cart::add($this->item->id, $this->item->name, $this->item->getRawOriginal('unit_price'), 1);
                $this->dispatch('addItem');
                $this->records = [];
            }
            if ($newQuantity == 0) {
                $this->dispatch('errorAddItem', name: $this->item->name, quantity: $this->item->receiving_quantity);
                $this->records = [];
            }
        }

        $this->search = '';
    }

    public function render()
    {
        return view('livewire.sale.scan-item');
    }
}
