<?php

namespace App\Livewire\Customer\Address;

use App\Models\Address;
use App\Models\City;
use App\Models\Customer;
use App\Models\CustomerAddress;
use LivewireUI\Modal\ModalComponent;

class CreateAddress extends ModalComponent
{
    public Customer $customer;
    public $line_1;
    public $line_2;
    public $district;
    public $city_id;
    public $postal_code;

    public $cities = [];
    protected $rules = [
        'line_1' => 'required|string|max:255',
        'line_2' => 'required|string|max:255',
        'district' => 'required|string'
    ];

    public function submit()
    {
        $this->validate();

        $address = new Address();
        $address->line_1 = $this->line_1;
        $address->line_2 = $this->line_2;
        $address->district = $this->district;
        $address->city_id = $this->city_id;
        $address->postal_code = $this->postal_code;
        $address->save();

        $customer_address = new CustomerAddress();
        $customer_address->address_id = $address->id;
        $customer_address->customer_id = $this->customer->id;
        $customer_address->save();

        $this->dispatch('address-created');

        $this->closeModal();
    }
    public function mount()
    {
        $this->cities = City::pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.customer.address.create-address');
    }
}
