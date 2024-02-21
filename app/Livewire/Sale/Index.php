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
        Cart::instance('order')->destroy();
        Cart::instance('estimate')->destroy();
    }

    #[On('errorAddItem')]
    public function errorAddItem($name, $quantity)
    {
        $this->alert('error', "Item {$name} is only {$quantity} stocks? ", [
            'position' => 'center',
            'toast' => false,
            'timer' => 3000,
        ]);
    }

    public function mount($option)
    {
        $this->option = $option;
    }

    public function onSwitchView($view)
    {
        return $this->redirect('/sales/'. $view, navigate: true);
    }

    public function render()
    {
        return view('livewire.sale.index');
    }
}
