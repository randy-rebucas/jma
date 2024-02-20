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
            <x-text-input wire:model.live="search" class="py-2" type="search" :placeholder="__('Search Suppliers...')" />
            <x-secondary-button class="ms-3 py-3"
                wire:click="$dispatch('openModal', { component: 'supplier.create-supplier' })">
                {{ __('Create Supplier') }}
            </x-secondary-button>
        </div>

        <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
            <x-table for="supplier">
                <x-table.thead>
                    <x-table.row class="dark:bg-gray-900 dark:text-gray-100">
                        <x-table.thead-cell :title="__('Full Name')" class="text-left" />
                        <x-table.thead-cell :title="__('Company Name')" class="text-left" />
                        <x-table.thead-cell :title="__('Email')" class="text-left" />
                        <x-table.thead-cell :title="__('Phone Number')" class="text-center" />
                        <x-table.thead-cell title="" class="text-right" />
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
                                    wire:click="$dispatch('openModal', {component: 'supplier.edit-supplier', arguments: {supplier: {{ $supplier }} }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                    </svg>
                                </button>
                                <button type="button" class="btn btn-info m-1 text-red-600 font-medium underline"
                                    wire:click="delete({{ $supplier->id }})"
                                    wire:confirm="Are you sure you want to delete this supplier?">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                    </svg>
                                </button>
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
