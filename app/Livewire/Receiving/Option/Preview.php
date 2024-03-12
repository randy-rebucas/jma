<?php

namespace App\Livewire\Receiving\Option;

use App\Models\Receiving;
use Livewire\Component;
use Livewire\WithPagination;

class Preview extends Component
{
    use WithPagination;
    public $search;
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
