<?php

namespace App\Livewire\Sale;

use App\Models\Item;
use Livewire\Component;
use Livewire\Attributes\On;
use Gloudemans\Shoppingcart\Facades\Cart;
class Items extends Component
{
    public function remove($rowId): void
    {
        Cart::instance('default')->remove($rowId);
        $this->dispatch('removeItem', $rowId);
    }

    public function clearCart(): void
    {
        Cart::instance('default')->destroy();
        $this->dispatch('clearItem');
    }

    public function increment($rowId): void
    {
        $item = Cart::instance('default')->get($rowId);
        Cart::instance('default')->update($rowId, $item->qty <= 9 ? $item->qty + 1 : $item->qty); // Will update the quantity
        $this->dispatch('updateItem');
    }

    public function decrement($rowId): void
    {
        $item = Cart::instance('default')->get($rowId);
        Cart::instance('default')->update($rowId, $item->qty !== 0 ? $item->qty - 1 : $item->qty); // Will update the quantity
        $this->dispatch('updateItem');
    }

    #[On('successAddItem')]
    #[On('saleCompleted')]
    #[On('saleCanceled')]
    #[On('removeItem')]
    #[On('clearItem')]
    #[On('updateItem')]
    public function render()
    {
        $content = Cart::instance('default')->content();

        return view('livewire.sale.items', compact('content'));
    }
}
