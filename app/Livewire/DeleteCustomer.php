<?php

namespace App\Livewire;

use LivewireUI\Modal\ModalComponent;
use App\Models\Customer;

class DeleteCustomer extends ModalComponent
{
    public Customer $customer;

    public function mount(Customer $customer)
    {
        $this->customer = $customer;

        $this->first_name = $this->customer->first_name; // or however you have it.
        $this->last_name = $this->customer->last_name;
        $this->phone_number = $this->customer->phone_number;

    }

    public function delete(): void
    {

        $this->customer->delete();

        $this->dispatch('customer-deleted');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.pages.customer.delete-customer');
    }
}
