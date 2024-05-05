<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]
class DetailCustomer extends Component
{
    public Customer $customer;

    public function mount($customerId)
    {
        $this->customer = Customer::findOrFail($customerId);
    }
    public function render()
    {
        return view('livewire.customer.detail-customer');
    }
}
