<?php

namespace App\Livewire\Sale\Option;

use Gloudemans\Shoppingcart\Facades\Cart;
use Livewire\Component;
use Livewire\Attributes\On;

class Register extends Component
{
    public $mode;
    public $total;

    #[On('changeMode')]
    public function changeMode($mode)
    {
        $this->setMode($mode);
    }

    public function setMode($mode) {
        session()->put('sale-mode', $mode);
    }

    public function getMode() {
        if (!session('sale-mode')) {
            $this->setMode(config('settings.sale_register_mode'));
        }

        return session('sale-mode');
    }

    #[On('addItem')]
    #[On('removeItem')]
    #[On('clearItem')]
    public function mount()
    {
        $this->total = Cart::instance('default')->total();
        $this->mode = $this->getMode();
    }

    public function render()
    {
        return view('livewire.sale.option.register');
    }
}
