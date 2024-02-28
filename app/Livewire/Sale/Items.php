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

    #[On('successAddItem')]
    #[On('saleCompleted')]
    #[On('saleCanceled')]
    #[On('removeItem')]
    #[On('clearItem')]
    public function render()
    {
        $content = Cart::instance('default')->content();

        return view('livewire.sale.items', compact('content'));
    }
}
