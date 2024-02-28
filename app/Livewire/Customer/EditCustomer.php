<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use LivewireUI\Modal\ModalComponent;

class EditCustomer extends ModalComponent
{
    public $first_name;
    public $last_name;
    public $phone_number;

    public $customerId;

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone_number' => 'required'
    ];
    public function mount()
    {
        $this->customer = Customer::find($this->customerId);

        $this->first_name = $this->customer->first_name; // or however you have it.
        $this->last_name = $this->customer->last_name;
        $this->phone_number = $this->customer->phone_number;

    }

    public function update(): void
    {
        $validated = $this->validate();

        $this->customer->update($validated);

        $this->dispatch('customer-updated');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.customer.edit-customer');
    }
}
