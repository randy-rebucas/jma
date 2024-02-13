<?php
use Livewire\WithPagination;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Illuminate\View\View;
use App\Models\Customer;
use App\Models\User;

new class extends Component {
    use WithPagination;

    public $search;

    #[On('customer-created')]
    #[On('customer-updated')]
    #[On('customer-deleted')]
    public function with(): array
    {
        return [
            'customers' => Customer::search('first_name', $this->search)->paginate(10),
        ];
    }

    public function delete($id): void
    {
        $customer = Customer::find($id);
        $customer->delete();

        $user = User::find($customer->user->id);
        $user->delete();

        $this->dispatch('customer-deleted');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Manage Customers') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Create, Edit, Delete and Search Customers.') }}
        </p>
    </header>

    <div class="mt-6 space-y-6">

        <div class="flex justify-between">
            <x-text-input wire:model.live="search" class="py-2" type="search" placeholder="Search Customers..." />
            <x-secondary-button class="ms-3 py-3" wire:click="$dispatch('openModal', { component: 'create-customer' })">
                {{ __('Create Customer') }}
            </x-secondary-button>
        </div>

        <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
            <x-table for="customer">
                <x-table.thead>
                    <x-table.row>
                        <x-table.thead-cell title="First Name" class="text-left" />
                        <x-table.thead-cell title="Last Name" class="text-left" />
                        <x-table.thead-cell title="Email" class="text-left" />
                        <x-table.thead-cell title="Phone Number" class="text-center" />
                        <x-table.thead-cell title="Actions" class="text-right" />
                    </x-table.row>
                </x-table.thead>
                <x-table.tbody>
                    @forelse ($customers as $customer)
                        <x-table.row class="bg-white" wire:loading.class="opacity-50">
                            <x-table.tbody-cell :item="$customer->first_name" />
                            <x-table.tbody-cell :item="$customer->last_name" />
                            <x-table.tbody-cell :item="$customer->user->email" />
                            <x-table.tbody-cell :item="$customer->phone_number" class="text-center" />
                            <x-table.tbody-cell :item="$customer->id" class="text-right" :action="true">
                                <button type="button" class="btn btn-info m-1 font-medium underline"
                                    wire:click="$dispatch('openModal', {component: 'edit-customer', arguments: {customer: {{ $customer }} }})">Edit</button>
                                <button type="button" class="btn btn-info m-1 text-red-600 font-medium underline" wire:click="delete({{ $customer->id }})"
                                    wire:confirm="Are you sure you want to delete this post?">Delete</button>
                            </x-table.tbody-cell>
                        </x-table.row>
                    @empty
                        <x-table.row class="bg-white">
                            <x-table.tbody-cell colspan="6" :item="'No customer found!!'" />
                        </x-table.row>
                    @endforelse
                </x-table.tbody>
            </x-table>
        </div>
        <div>
            {{ $customers->links() }}
        </div>
    </div>
</section>
