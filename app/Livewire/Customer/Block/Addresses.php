<?php

namespace App\Livewire\Customer\Block;

use App\Models\City;
use App\Models\Customer;
use App\Models\CustomerAddress;
use Livewire\Attributes\On;
use Livewire\Component;

class Addresses extends Component
{
    public Customer $customer;
    public function delete($id)
    {

        $customer_address = CustomerAddress::find($id);
        $customer_address->delete();

        $this->dispatch('address-deleted');
    }

    #[On('address-created')]
    #[On('address-deleted')]
    public function render()
    {
        $addresses = CustomerAddress::with('address')->where("customer_id", $this->customer->id)->get();
        
        return view('livewire.customer.block.addresses', compact('addresses'));
    }
}
