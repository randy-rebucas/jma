<?php

namespace App\Livewire\Sale;

use App\Models\Item;
use Livewire\Component;

class ScanItem extends Component
{
    public $showresult = false;
    public $search;
    public $records;

    // Fetch records
    public function searchResult()
    {
        if (!empty($this->search)) {

            $this->records = Item::orderby('name', 'asc')
                ->select('*')
                ->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('item_number','like', '%' . $this->search . '%')
                ->orWhere('code','like', '%' . $this->search . '%')
                ->limit(8)
                ->get();

            $this->showresult = true;
        } else {
            $this->showresult = false;
        }
    }

    // Fetch record by ID
    public function setItem($id = 0)
    {
        $this->dispatch('selectedItem', $id);
    }
    public function findItem()
    {
        dd("triggered");
    }
    public function render()
    {
        return view('livewire.sale.scan-item');
    }
}
