<?php

namespace App\Livewire\Sale\Job;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class Order extends Component
{
    #[Validate('required|max:225')] 
    public $scope_name;

    #[Validate('required')] 
    public $scope_amount;

    public function add() {
        Cart::instance('order')->add(Str::uuid(), $this->scope_name, 1, $this->scope_amount);
        
        $this->scope_amount = '';
        $this->scope_name = '';
        $this->dispatch('updateJobLists');
    }

    public function remove($rowId) {    
        Cart::instance('order')->remove($rowId);
        $this->dispatch('updateJobLists');
    }

    #[On('updateJobLists')]
    #[On('saleCompleted')]
    public function render()
    {
        $content = Cart::instance('order')->content();
        return view('livewire.sale.job.order', compact('content'));
    }
}
