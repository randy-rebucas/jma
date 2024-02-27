<?php

namespace App\Livewire\Sale\Option;

use App\Models\Sale;
use Livewire\Component;

class Preview extends Component
{
    public function registerView()
    {
        return $this->redirect('/sales/register', navigate: true);
    }
    
    public function render()
    {
        $items = Sale::paginate(10);
        return view('livewire.sale.option.preview', compact('items'));
    }
}
