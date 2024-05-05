<?php

namespace App\Livewire\Customer\Block;

use App\Models\Customer;
use Livewire\Component;

class PurchasedHistories extends Component
{
    public Customer $customer;

    public function render()
    {
        $sales = $this->customer->sales;
        $jobs = $this->customer->jobs;
        return view('livewire.customer.block.purchased-histories', compact('sales', 'jobs'));
    }
}
