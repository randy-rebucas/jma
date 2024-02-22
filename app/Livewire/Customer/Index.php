<?php

namespace App\Livewire\Customer;

use Livewire\WithPagination;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use App\Models\Customer;
use App\Models\User;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $search;

    public function delete($id): void
    {
        $customer = Customer::find($id);
        $customer->delete();

        $user = User::find($customer->user->id);
        $user->delete();

        $this->dispatch('customer-deleted');
    }

    public function onView($customer_id)
    {
        return $this->redirectRoute('customer-detail', ['customerId'=> $customer_id]);
    }

    #[On('customer-created')]
    #[On('customer-updated')]
    #[On('customer-deleted')]
    public function render()
    {
        $customers = Customer::with('sales')->search('first_name', $this->search)->paginate(10);

        return view('livewire.customer.index', compact('customers'));
    }
}
