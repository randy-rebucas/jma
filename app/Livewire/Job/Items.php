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

    #[On('successAddItem')]
    #[On('saleCompleted')]
    #[On('saleCanceled')]
    #[On('removeItem')]
    #[On('clearItem')]
    public function render()
    {
        $content = Cart::instance('job')->content();
        return view('livewire.job.items', compact('content'));

    }
}
