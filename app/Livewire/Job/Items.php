<?php

namespace App\Livewire\Job;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class Items extends Component
{
    public function remove($rowId): void
    {
        Cart::instance('job')->remove($rowId);
        $this->dispatch('removeItem', $rowId);
    }

    public function clearCart(): void
    {
        Cart::instance('job')->destroy();
        $this->dispatch('clearItem');
    }

    public function increment($rowId): void
    {
        $item = Cart::instance('job')->get($rowId);
        Cart::instance('job')->update($rowId, $item->qty <= 9 ? $item->qty + 1 : $item->qty); // Will update the quantity
        $this->dispatch('updateItem');
    }

    public function decrement($rowId): void
    {
        $item = Cart::instance('job')->get($rowId);
        Cart::instance('job')->update($rowId, $item->qty !== 0 ? $item->qty - 1 : $item->qty); // Will update the quantity
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
        $content = Cart::instance('job')->content();
        return view('livewire.job.items', compact('content'));
    }
}
