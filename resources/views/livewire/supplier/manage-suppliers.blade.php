<?php
use Livewire\WithPagination;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\Supplier;
use App\Models\User;

new class extends Component {
    use WithPagination;

    public $search;

    #[On('supplier-created')]
    #[On('supplier-updated')]
    #[On('supplier-deleted')]
    public function with(): array
    {
        return [
            'suppliers' => Supplier::search('first_name', $this->search)->paginate(10),
        ];
    }

    public function delete($id): void
    {
        $supplier = Supplier::find($id);
        $supplier->delete();

        $user = User::find($supplier->user->id);
        $user->delete();

        $this->dispatch('supplier-deleted');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Manage Supplier') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Create, Edit, Delete and Search Supplier.') }}
        </p>
    </header>

    <div class="mt-6 space-y-6">

        <div class="flex justify-between">
            <x-text-input wire:model.live="search" class="py-2" type="search" placeholder="Search Suppliers..." />
            <x-secondary-button class="ms-3 py-3"
                wire:click="$dispatch('openModal', { component: 'supplier.create-supplier' })">
                {{ __('Create Supplier') }}
            </x-secondary-button>
        </div>

        <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
            <x-table for="supplier">
                <x-table.thead>
                    <x-table.row class="dark:bg-gray-900 dark:text-gray-100">
                        <x-table.thead-cell title="Full Name" class="text-left" />
                        <x-table.thead-cell title="Company Name" class="text-left" />
                        <x-table.thead-cell title="Email" class="text-left" />
                        <x-table.thead-cell title="Phone Number" class="text-center" />
                        <x-table.thead-cell title="Actions" class="text-right" />
                    </x-table.row>
                </x-table.thead>
                <x-table.tbody class="dark:border-gray-500">
                    @forelse ($suppliers as $supplier)
                        <x-table.row class="bg-white dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
                            <x-table.tbody-cell :item="$supplier->full_name" />
                            <x-table.tbody-cell :item="$supplier->company_name" />
                            <x-table.tbody-cell :item="$supplier->user->email" />
                            <x-table.tbody-cell :item="$supplier->phone_number" class="text-center" />
                            <x-table.tbody-cell :item="$supplier->id" class="text-right" :action="true">
                                <button type="button" class="btn btn-info m-1 font-medium underline"
                                    wire:click="$dispatch('openModal', {component: 'supplier.edit-supplier', arguments: {supplier: {{ $supplier }} }})">Edit</button>
                                <button type="button" class="btn btn-info m-1 text-red-600 font-medium underline"
                                    wire:click="delete({{ $supplier->id }})"
                                    wire:confirm="Are you sure you want to delete this supplier?">Delete</button>
                            </x-table.tbody-cell>
                        </x-table.row>
                    @empty
                        <x-table.row class="bg-white dark:bg-gray-700 dark:text-white">
                            <x-table.tbody-cell colspan="6" :item="'No supplier found!!'" />
                        </x-table.row>
                    @endforelse
                </x-table.tbody>
            </x-table>
        </div>
        <div>
            {{ $suppliers->links() }}
        </div>
    </div>
</section>
