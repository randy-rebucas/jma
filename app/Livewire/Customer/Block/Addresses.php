<?php

namespace App\Livewire\Customer\Block;

use App\Models\Customer;
use Livewire\Component;

class Addresses extends Component
{
    public Customer $customer;
    public function render()
    {
        return view('livewire.customer.block.addresses');
    }
}
