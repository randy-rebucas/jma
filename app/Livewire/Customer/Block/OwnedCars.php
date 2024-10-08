<?php

namespace App\Livewire\Customer\Block;

use Livewire\Attributes\On;
use App\Models\Customer;
use App\Models\CustomerCar;
use Livewire\Component;

class OwnedCars extends Component
{
    public Customer $customer;

    public function delete($id) {

        $customer_car = CustomerCar::find($id);
        $customer_car->delete();

        $this->dispatch('car-deleted');
    }

    #[On('car-created')]
    #[On('car-deleted')]
    public function render()
    {
        $cars = CustomerCar::with('car')->where("customer_id", $this->customer->id)->get();

        return view('livewire.customer.block.owned-cars', compact('cars'));
    }
}
