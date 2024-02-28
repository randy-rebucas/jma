<?php

namespace App\Livewire\Receiving;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\On;

class Total extends Component
{
    public $total;
    public $count;

    #[On('saleCompleted')]
    #[On('saleCanceled')]
    #[On('removeItem')]
    #[On('addItem')]
    #[On('clearItem')]
    public function mount(): void
    {
        $this->total = Cart::instance('receiving')->total();
        $this->count = Cart::instance('receiving')->count();
    }
    public function render()
    {
        return view('livewire.receiving.total');
    }
}
