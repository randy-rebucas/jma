<?php

namespace App\Livewire\Receiving;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.receiving.index');
    }
}
