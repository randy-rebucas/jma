<?php

namespace App\Livewire\Pos;

use App\Models\Item;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\On;
class ScanItem extends Component
{
    public $search;
    public $records;

    public Item $item;
    // Fetch records
    public function searchResult()
    {
        $this->records = Item::orderby('name', 'asc')
            ->select('*')
            ->where('receiving_quantity', '>=', 1)
            ->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('item_number', 'like', '%' . $this->search . '%')
            ->orWhere('code', 'like', '%' . $this->search . '%')
            ->take(5)
            ->get();
    }

    public function inCart()
    {
        return Cart::instance('default')->search(function ($cartItem, $rowId) {
            return $cartItem->id === $this->item->id;
        });
    }
    
    #[On('errorAddItem')]
    public function errorAddItem($name, $quantity)
    {
        $this->alert('error', "Item {$name} is only {$quantity} stocks? ", [
            'position' => 'center',
            'toast' => false,
            'timer' => 3000,
        ]);
    }
    public function setItem($id = 0)
    {
        $this->item = Item::findOrFail($id);

        if (is_null($this->inCart()->first())) {
            if ($this->item->receiving_quantity >= 1) {
                Cart::instance('default')->add($this->item->id, $this->item->name, 1, $this->item->getRawOriginal('unit_price'));
                $this->dispatch('addItem');
                $this->records = [];
            }
        } else {
            /**
             * scenario
             * 2 > 1 || 2 == 2
             */
            $newQuantity = $this->item->receiving_quantity - $this->inCart()->first()->qty;

            if ($this->item->receiving_quantity > $newQuantity && $newQuantity > 0) {
                Cart::instance('default')->add($this->item->id, $this->item->name, 1, $this->item->getRawOriginal('unit_price'));
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
        return view('livewire.pos.scan-item');
    }
}
