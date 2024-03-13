<?php

namespace App\Livewire\GlobalSearch;

use App\Models\CustomerCar;
use Livewire\Component;

class Lookup extends Component
{
    public $searchTerm;
    public $results = [];

    public function lookup()
    {
        $this->results = CustomerCar::search($this->searchTerm)->get();
    }
    
    public function onClickItem($id) {
        return $this->redirectRoute('search-result', ['carId' => $id]);
    }   
    public function render()
    {
        return view('livewire.global-search.lookup');
    }
}
