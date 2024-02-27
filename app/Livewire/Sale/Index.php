<?php

namespace App\Livewire\Sale;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Gloudemans\Shoppingcart\Facades\Cart;

#[Layout('layouts.app')]
class Index extends Component
{
    use LivewireAlert;

    public $option;

    #[On('saleCompleted')]
    public function saleCompleted($serial)
    {
        $this->alert('success', "{$serial} successfully registered?", [
            'position' => 'center',
            'toast' => false,
            'timer' => 3000,
        ]);

        Cart::instance('default')->destroy();
    }

    public function mount($option)
    {
        $this->option = $option;
    }

    public function render()
    {
        return view('livewire.sale.index');
    }
}
