<?php

namespace App\Livewire\Pos;

use App\Models\Customer;
use App\Models\CustomerCar;
use Livewire\Component;
use Livewire\Attributes\On;

class ScanCustomer extends Component
{
    public $showCarLists = false;
    public $types = [];
    public $search;
    public $records;
    public $details;
    public $customerId;
    public $carId;
    public $cars = [];

    public function searchResult()
    {
        $this->records = Customer::orderby('first_name', 'asc')
            ->select('*')
            ->where('first_name', 'like', '%' . $this->search . '%')
            ->orWhere('last_name', 'like', '%' . $this->search . '%')
            ->take(5)
            ->get();
    }

    public function setCustomer($id)
    {
        $record = Customer::select('*')
            ->where('id', $id)
            ->first();

        $this->details = $record;
        $this->customerId = $id;
        $this->records = [];
        $this->search = '';
        $this->cars = CustomerCar::with('car')->where('customer_id', $record->id)->get()->pluck('car.plate_number', 'car_id');

        $this->dispatch('setCustomer', customerId: $id);
    }

    public function setCar($id)
    {
        $this->dispatch('setCar', carId: $id);
    }

    #[On('saleCompleted')]
    public function clearCustomerId()
    {
        $this->details = null;
        $this->customerId = null;
        $this->records = [];
        $this->search = '';
        $this->carId = null;
        $this->cars = [];
        $this->showCarLists = false;
    }

    public function mount(): void
    {
        if ($this->customerId) {
            $this->setCustomer($this->customerId);
        }
    }

    public function render()
    {
        return view('livewire.pos.scan-customer');
    }
}
