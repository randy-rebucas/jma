<?php

namespace App\Livewire\Sale\Option;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Traits\CartSession;

class Register extends Component
{
    use CartSession;
    public $mode;
    public $total;

    #[On('changeMode')]
    public function changeMode($mode)
    {
        $this->mode = $mode;
    }
    
    #[On('addItem')]
    #[On('removeItem')]
    #[On('clearItem')]
    public function mount()
    {
        $this->total = Cart::instance('default')->total();
    }

    public function render()
    {
        return view('livewire.sale.option.register');
    }
}
