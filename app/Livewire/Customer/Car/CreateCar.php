<?php

namespace App\Livewire\Customer\Car;

use App\Models\Customer;
use LivewireUI\Modal\ModalComponent;
use App\Models\Car;
use App\Models\CustomerCar;
class CreateCar extends ModalComponent
{
    public Customer $customer;
    public $brand;
    public $plate_number;
    public $model;
    public $color;
    public $odo_km;
    public $engine_number;
    public $chassis_number;
    public $year;

    protected $rules = [
        'brand' => 'required|string|max:255',
        'plate_number' => 'required|string|max:255',
        'model' => 'required|string',
        'color' => 'required|string',
    ];

    public function submit()
    {
        $this->validate();

        $car = new Car();
        $car->brand = $this->brand;
        $car->plate_number = $this->plate_number;
        $car->model = $this->model;
        $car->color = $this->color;
        $car->odo_km = $this->odo_km;
        $car->engine_number = $this->engine_number;
        $car->chassis_number = $this->chassis_number;
        $car->year = $this->year;
        $car->save();

        $customer_car = new CustomerCar();
        $customer_car->car_id = $car->id;
        $customer_car->customer_id = $this->customer->id;
        $customer_car->save();

        $this->dispatch('car-created');

        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.customer.car.create-car');
    }
}
