<?php

namespace App\Livewire\Pos;

use App\Models\Item;
use Livewire\Component;
use Livewire\Attributes\On;
class ScanItem extends Component
{
    public $search;
    public $records;

    // Fetch records
    public function searchResult()
    {
        $this->records = Item::orderby('name', 'asc')
            ->select('*')
            ->where('receiving_quantity', '>=', 1)
            ->where('name', 'like', '%' . $this->search . '%')
            ->take(5)
            ->get();
    }
    
    #[On('errorAddItem')]
    public function errorAddItem($name, $quantity)
    {
        $this->alert('error', "Item {$name} is only {$quantity} stocks? ", [
            'position' => 'center',
            'toast' => false,
            'timer' => 3000,
        ]);
    }
    public function setItem($id = 0)
    {
        $this->dispatch('addItem', id: $id);
    
        $this->search = '';
        $this->records = [];
    }
    public function render()
    {
        return view('livewire.pos.scan-item');
    }
}
