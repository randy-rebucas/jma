<?php

namespace App\Livewire\Pos;

use Livewire\Component;
use Livewire\Attributes\On;
use Gloudemans\Shoppingcart\Facades\Cart;

class Total extends Component
{

    public $amount;
    public $details;
    public $total;
    public $total_quantity;

    #[On('saleCompleted')]
    #[On('saleCanceled')]
    #[On('removeItem')]
    #[On('addItem')]
    #[On('clearItem')]
    #[On('updateJobLists')]
    public function mount(): void
    {
        $this->amount = 0;
        $this->details = null;
        $this->total = Cart::instance('default')->total() + Cart::instance('job')->total();
        $this->total_quantity = Cart::instance('default')->count() + Cart::instance('job')->count();
    }
    public function render()
    {
        return view('livewire.pos.total');
    }
}
