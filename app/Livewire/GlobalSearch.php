<?php

namespace App\Livewire;

use App\Models\Car;
use App\Models\CustomerCar;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class GlobalSearch extends Component
{
    public $searchTerm;
    public $results = [];

    public function search()
    {
        $this->results = CustomerCar::search($this->searchTerm)->get();
    }
    
    public function onClickItem($id) {
        dd($id);
        $this->results = [];
    }   

    public function render()
    {
        return view('livewire.global-search');
    }
}
