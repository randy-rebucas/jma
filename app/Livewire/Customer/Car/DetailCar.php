<?php

namespace App\Livewire\Customer\Car;

use App\Models\Car;
use Livewire\Component;

class DetailCar extends Component
{
    public Car $car;

    public function mount(Car $car) {
        $this->car = $car;
    }

    public function render()
    {
        return view('livewire.customer.car.detail-car');
    }
}
