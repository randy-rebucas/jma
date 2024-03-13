<?php

namespace App\Livewire\Receiving;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Traits\CartSession;

#[Layout('layouts.app')]
class Index extends Component
{
    use LivewireAlert;
    use CartSession;

    public $option;
    public $mode;

    #[On('changeMode')]
    public function changeMode($mode)
    {
        $this->mode = $mode;
    }

    #[On('saleCompleted')]
    public function saleCompleted($serial)
    {
        $this->alert('success', "{$serial} successfully registered?", [
            'position' => 'center',
            'toast' => false,
            'timer' => 3000,
        ]);

        Cart::instance('receiving')->destroy();
    }

    public function mount($option)
    {
        $this->mode = $this->getModeValue('receiving-mode', 'receiving');
        $this->option = $option;
    }
    public function render()
    {
        return view('livewire.receiving.index');
    }
}
