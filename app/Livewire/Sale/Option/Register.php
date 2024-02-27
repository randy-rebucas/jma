<?php

namespace App\Livewire\Sale\Option;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\Attributes\On;

class Register extends Component
{
    public $mode;
    public $total;

    #[On('change-mode')]
    public function changeRegisterMode($mode)
    {
        $this->mode = $mode;
    }

    #[On('addItem')]
    #[On('removeItem')]
    #[On('clearItem')]
    public function mount()
    {
        $this->total = Cart::instance('default')->total() + Cart::instance('job')->total();
        $this->mode = session('mode');
    }

    public function render()
    {
        return view('livewire.sale.option.register');
    }
}
