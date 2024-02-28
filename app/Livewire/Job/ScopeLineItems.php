<?php

namespace App\Livewire\Job;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\On;

class ScopeLineItems extends Component
{
    public function remove($rowId)
    {
        Cart::instance('scope')->remove($rowId);
        $this->dispatch('updateJobLists');
    }

    #[On('updateJobLists')]
    #[On('saleCompleted')]
    public function render()
    {
        $content = Cart::instance('scope')->content();
        return view('livewire.job.scope-line-items', compact('content'));
    }
}
