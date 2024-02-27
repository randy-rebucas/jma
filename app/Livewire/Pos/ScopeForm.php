<?php

namespace App\Livewire\Pos;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

class ScopeForm extends Component
{
    #[Validate('required|max:225')] 
    public $scope_name;

    #[Validate('required')] 
    public $scope_amount;

    public function add() {
        Cart::instance('job')->add(Str::uuid(), $this->scope_name, 1, $this->scope_amount);
        
        $this->scope_amount = '';
        $this->scope_name = '';
        $this->dispatch('updateJobLists');
    }
    public function render()
    {
        return view('livewire.pos.scope-form');
    }
}
