<?php
use Livewire\WithPagination;
use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\Item;

new class extends Component {
    use WithPagination;

    public $search;

    #[On('item-created')]
    #[On('item-updated')]
    #[On('item-deleted')]
    public function with(): array
    {
        return [
            'items' => Item::search('name', $this->search)->paginate(10),
        ];
    }

    public function delete($id): void
    {
        $item = Item::find($id);
        $item->delete();

        $this->dispatch('item-deleted');
    }
}; ?>

<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Manage Items') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Create, Edit, Delete and Search Items.') }}
        </p>
    </header>
    <div class="mt-6 space-y-6">

        <div class="flex justify-between">
            <x-text-input wire:model.live="search" class="py-2" type="search" placeholder="Search Items..." />
            <x-secondary-button class="ms-3 py-3" wire:click="$dispatch('openModal', { component: 'item.create-item' })">
                {{ __('Create Item') }}
            </x-secondary-button>
        </div>

        <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
            <x-table for="items">
                <x-table.thead>
                    <x-table.row>
                        <x-table.thead-cell title="Name" class="text-left" />
                        <x-table.thead-cell title="Code" class="text-left" />
                        <x-table.thead-cell title="Item Number" class="text-left" />
                        <x-table.thead-cell title="Cost Price" class="text-right" />
                        <x-table.thead-cell title="Unit Price" class="text-right" />
                        <x-table.thead-cell title="ReOrder Level" class="text-center" />
                        <x-table.thead-cell title="Quantity" class="text-center" />
                        <x-table.thead-cell title="Category" class="text-left" />
                        <x-table.thead-cell title="Actions" class="text-right" />
                    </x-table.row>
                </x-table.thead>
                <x-table.tbody>
                    @forelse ($items as $item)
                        <x-table.row class="bg-white" wire:loading.class="opacity-50">
                            <x-table.tbody-cell :item="$item->name" />
                            <x-table.tbody-cell :item="$item->code" />
                            <x-table.tbody-cell :item="$item->item_number" />
                            <x-table.tbody-cell :item="number_format($item->cost_price, 2)" class="text-right" />
                            <x-table.tbody-cell :item="number_format($item->unit_price, 2)" class="text-right"/>
                            <x-table.tbody-cell :item="$item->reorder_level" class="text-center"/>
                            <x-table.tbody-cell :item="$item->receiving_quantity" class="text-center" />
                            <x-table.tbody-cell :item="$item->category->name" />
                            <x-table.tbody-cell :item="$item->id" :action="true" class="text-right">
                                <button type="button" class="btn btn-info m-1 font-medium underline"
                                    wire:click="$dispatch('openModal', {component: 'item.edit-item', arguments: {item: {{ $item }} }})">Edit</button>
                                <button type="button" class="btn btn-info m-1 text-red-600 font-medium underline"
                                    wire:click="delete({{ $item->id }})"
                                    wire:confirm="Are you sure you want to delete this item?">Delete</button>
                            </x-table.tbody-cell>
                        </x-table.row>
                    @empty
                        <x-table.row class="bg-white">
                            <x-table.tbody-cell colspan="9" :item="'No item found!!'" />
                        </x-table.row>
                    @endforelse
                </x-table.tbody>
            </x-table>
        </div>
        <div>
            {{ $items->links() }}
        </div>
    </div>
</section>
