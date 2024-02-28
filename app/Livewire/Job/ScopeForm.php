<?php

namespace App\Livewire\Job;

use LivewireUI\Modal\ModalComponent;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

class ScopeForm extends ModalComponent
{
    public $scope_name;
    public $scope_amount;

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    protected $rules = [
        'scope_name' => 'required|string|max:255',
        'scope_amount' => 'required'
    ];

    public function submit() {
        $this->validate();
    
        Cart::instance('scope')->add(Str::uuid(), $this->scope_name, 1, $this->scope_amount);

        $this->dispatch('updateJobLists');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.job.scope-form');
    }
}
