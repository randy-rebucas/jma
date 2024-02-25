<?php

namespace App\Livewire\Job;

use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

class Details extends Component
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
        return view('livewire.job.details', compact('content'));
    }
}
