<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Livewire\Component;

class AutoCompleteCustomer extends Component
{
    public $showresult = false;
    public $search = "";
    public $records;
    public $details;

    // Fetch records
    public function searchResult()
    {

        if (!empty($this->search)) {

            $this->records = Customer::orderby('first_name', 'asc')
                ->select('*')
                ->where('first_name', 'like', '%' . $this->search . '%')
                ->limit(5)
                ->get();

            $this->showresult = true;
        } else {
            $this->showresult = false;
        }
    }

    // Fetch record by ID
    public function fetchDetail($id = 0)
    {
        $record = Customer::select('*')
            ->where('id', $id)
            ->first();

        $this->search = $record->first_name;
        $this->details = $record;
        $this->showresult = false;

        $this->dispatch('selectedCustomer', $id);
    }
    // Magic method that is fired when `streetAddress` is updated
    public function render()
    {
        return view('livewire.customer.auto-complete-customer');
    }
}
