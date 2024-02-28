<?php

namespace App\Livewire\Receiving\Option;

use App\Models\Receiving;
use Livewire\Component;

class Preview extends Component
{
    public function registerView()
    {
        return $this->redirect('/receivings/register', navigate: true);
    }
    
    public function render()
    {
        $items = Receiving::paginate(10);
        return view('livewire.receiving.option.preview', compact('items'));
    }
}
