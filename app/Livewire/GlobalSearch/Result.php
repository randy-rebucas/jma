<?php

namespace App\Livewire\GlobalSearch;

use App\Models\Car;
use App\Models\Customer;
use App\Models\CustomerCar;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Result extends Component
{
    public Car $car;
    public Customer $customer;
    public function mount($carId) {
        $customer_car = CustomerCar::where('car_id', $carId)->first();
        $this->car =  $customer_car?->car ?? new Car();
        $this->customer = $customer_car?->customer ?? new Customer();
    }
    public function render()
    {
        return view('livewire.global-search.result');
    }
}
