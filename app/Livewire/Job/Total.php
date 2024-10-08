<?php

namespace App\Livewire\Job;

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
    #[On('updateJobLists')]
    public function mount(): void
    {
        $this->total = Cart::instance('job')->total() + Cart::instance('scope')->total();
        $this->count = Cart::instance('job')->count() + Cart::instance('scope')->count();
    }

    public function render()
    {
        return view('livewire.job.total');
    }
}
