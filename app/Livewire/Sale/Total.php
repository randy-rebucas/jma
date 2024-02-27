<?php

namespace App\Livewire\Sale;

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
        $this->total = Cart::instance('default')->total();
        $this->count = Cart::instance('default')->count();
    }

    public function render()
    {
        return view('livewire.sale.total');
    }
}
