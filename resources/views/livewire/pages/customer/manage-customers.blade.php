<?php
use Livewire\WithPagination;
use Livewire\Volt\Component;
use Illuminate\View\View;
use App\Models\Customer;

new class extends Component {
    use WithPagination;

    public $search;

    public function with(): array
    {
        return [
            'customers' => Customer::search('first_name', $this->search)->paginate(10),
        ];
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Manage Customers') }} {{ $search }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Create, Edit, Delete and Search Customers.') }}
        </p>
    </header>

    <div class="mt-6 space-y-6">

        <div>
            <x-text-input wire:model.live="search" type="search" placeholder="Search Customers..." />
        </div>

        <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
            <x-table for="customer">
                <x-table.thead>
                    <x-table.row>
                        <x-table.thead-cell title="First Name" class="text-left" />
                        <x-table.thead-cell title="Last Name" class="text-left" />
                        <x-table.thead-cell title="Email" class="text-left" />
                        <x-table.thead-cell title="Phone Number" class="text-right" />
                    </x-table.row>
                </x-table.thead>
                <x-table.tbody>
                    @forelse ($customers as $customer)
                        <x-table.row class="bg-white" wire:loading.class="opacity-50">
                            <x-table.tbody-cell :item="$customer->first_name" />
                            <x-table.tbody-cell :item="$customer->last_name" />
                            <x-table.tbody-cell :item="$customer->user->email" />
                            <x-table.tbody-cell :item="$customer->phone_number" class="text-right" />
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
