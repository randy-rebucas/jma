<?php

namespace App\Livewire\Receiving;

use App\Models\Item;
use Livewire\Component;
use Livewire\Attributes\On;
use Gloudemans\Shoppingcart\Facades\Cart;

class Items extends Component
{
    public function remove($rowId): void
    {
        Cart::instance('receiving')->remove($rowId);
        $this->dispatch('removeItem', $rowId);
    }

    public function clearCart(): void
    {
        Cart::instance('receiving')->destroy();
        $this->dispatch('clearItem');
    }

    #[On('successAddItem')]
    #[On('saleCompleted')]
    #[On('saleCanceled')]
    #[On('removeItem')]
    #[On('clearItem')]
    public function render()
    {
        $content = Cart::instance('receiving')->content();
        return view('livewire.receiving.items', compact('content'));
    }
}
