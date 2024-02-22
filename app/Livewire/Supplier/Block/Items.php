<?php

namespace App\Livewire\Supplier\Block;

use Livewire\Component;

class Items extends Component
{
    public $items;
    
    public function render()
    {
        return view('livewire.supplier.block.items');
    }
}
