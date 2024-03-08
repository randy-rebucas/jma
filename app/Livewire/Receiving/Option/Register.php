<?php

namespace App\Livewire\Receiving\Option;

use App\Models\Item;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Traits\CartSession;

class Register extends Component
{
    use CartSession;
    public $mode;
    public $total;
    public $id;
    public Item $item;

    #[On('changeMode')]
    public function changeMode($mode)
    {
        $this->mode = $mode;
    }
    
    #[On('addItem')]
    #[On('removeItem')]
    #[On('clearItem')]
    public function mount()
    {
        $this->total = Cart::instance('receiving')->total();
    }
    public function inCart()
    {
        return Cart::instance('receiving')->search(function ($cartItem, $rowId) {
            return $cartItem->id === $this->item->id;
        });
    }

    #[On('addItem')]
    public function addItem($id)
    {
        $this->item = Item::findOrFail($id);
        if (is_null($this->inCart()->first())) {
            if ($this->item->receiving_quantity >= 1) {
                Cart::instance('receiving')->add($this->item->id, $this->item->name, 1, $this->item->price);
                $this->dispatch('successAddItem');
                $this->records = [];
            }
        } else {
            /**
             * scenario
             * 2 > 1 || 2 == 2
             */
            $newQuantity = $this->item->receiving_quantity - $this->inCart()->first()->qty;

            if ($this->item->receiving_quantity > $newQuantity && $newQuantity > 0) {
                Cart::instance('receiving')->add($this->item->id, $this->item->name, 1, $this->item->price);
                $this->dispatch('successAddItem');
                $this->records = [];
            }
            if ($newQuantity == 0) {
                $this->dispatch('errorAddItem', name: $this->item->name, quantity: $this->item->receiving_quantity);
                $this->records = [];
            }
        }
    }
    public function render()
    {
        return view('livewire.receiving.option.register');
    }
}
