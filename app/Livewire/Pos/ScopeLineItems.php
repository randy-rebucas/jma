<?php

namespace App\Livewire\Pos;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Attributes\On;

class ScopeLineItems extends Component
{
    public $mode;

    #[On('change-mode')]
    public function changeRegisterMode($mode)
    {
        $this->mode = $mode;
    }
    public function mount()
    {
        $this->mode = session('mode');
    }

    public function remove($rowId) {    
        Cart::instance('job')->remove($rowId);
        $this->dispatch('updateJobLists');
    }

    #[On('updateJobLists')]
    #[On('saleCompleted')]
    public function render()
    {
        $content = Cart::instance('job')->content();
        return view('livewire.pos.scope-line-items', compact('content'));
    }
}
