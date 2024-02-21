<?php

namespace App\Livewire\Sale\Option;

use Livewire\Component;

class Preview extends Component
{
    public function registerView()
    {
        return $this->redirect('/sales/register', navigate: true);
    }
    public function render()
    {
        return view('livewire.sale.option.preview');
    }
}
