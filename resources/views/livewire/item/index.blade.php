<x-slot name="header">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Manage Items') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Create, Edit, Delete and Search Items.') }}
    </p>
</x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="min-w-full">
                <div class="space-y-6">

                    <div class="flex justify-between">
                        <div class="flex gap-6">
                            <x-text-input wire:model.live="search" class="py-2" type="search" :placeholder="__('Search Items...')" />
                            <x-select wire:model="category" id="category" name="category"
                                wire:change="setCategory($event.target.value)" :options="$categories" class="" />
                        </div>
                        <div>
                            <x-secondary-button class="ms-3 py-3"
                                wire:click="$dispatch('openModal', { component: 'item.create-item' })">
                                {{ __('Create Item') }}
                            </x-secondary-button>
                            <x-secondary-button class="ms-3 py-3"
                                wire:click="$dispatch('openModal', { component: 'category.manage-category' })">
                                {{ __('Categories') }}
                            </x-secondary-button>
                            <x-primary-button class="ms-3 py-3" wire:click="print">
                                {{ __('Print') }}
                            </x-primary-button>
                        </div>
                    </div>

                    <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                        <x-table for="items">
                            <x-table.thead>
                                <x-table.row class="dark:bg-gray-900 dark:text-gray-100">
                                    <x-table.thead-cell :title="__('Part Number')" class="text-left" />
                                    <x-table.thead-cell :title="__('Name')" class="text-left" />
                                    <x-table.thead-cell :title="__('Category')" class="text-left" />
                                    <x-table.thead-cell :title="__('ReOrder Level')" class="text-center" />
                                    <x-table.thead-cell :title="__('Quantity Stocks')" class="text-center" />
                                    <x-table.thead-cell :title="__('Unit Price')" class="text-right" />
                                    <x-table.thead-cell :title="__('Cost Price')" class="text-right" />
                                    <x-table.thead-cell :title="__('Selling Price')" class="text-right" />
                                    <x-table.thead-cell title="" class="text-right" />
                                </x-table.row>
                            </x-table.thead>
                            <x-table.tbody class="dark:border-gray-500">
                                @forelse ($items as $item)
                                    @php
                                        switch (true) {
                                            case $item->receiving_quantity < $item->reorder_level &&
                                                $item->receiving_quantity > 1:
                                                $outOfStock = 'bg-red-50';
                                                break;
                                            case $item->receiving_quantity == 0:
                                                $outOfStock = 'bg-red-100';
                                                break;
                                            default:
                                                $outOfStock = 'bg-white';
                                                break;
                                        }
                                    @endphp
                                    <x-table.row class=" dark:bg-gray-700 dark:text-white {{ $outOfStock }}"
                                        wire:loading.class="opacity-50">
                                        <x-table.tbody-cell :item="$item->part_number" />
                                        <x-table.tbody-cell :item="$item->name" />
                                        <x-table.tbody-cell :item="$item->category->name" />
                                        <x-table.tbody-cell :item="$item->reorder_level" class="text-center" />
                                        <x-table.tbody-cell :item="$item->receiving_quantity" class="text-center" />
                                        <x-table.tbody-cell :item="$item->format_unit_price" :action="true" class="text-right">
                                            @currency($item->unit_price)
                                        </x-table.tbody-cell>
                                        <x-table.tbody-cell :item="$item->format_cost_price" :action="true" class="text-right">
                                            @currency($item->cost_price)
                                        </x-table.tbody-cell>
                                        <x-table.tbody-cell :item="$item->selling_price" :action="true" class="text-right">
                                            @currency($item->selling_price)
                                        </x-table.tbody-cell>
                                        <x-table.tbody-cell :item="$item->id" :action="true" class="text-right">
                                            <button type="button" class="btn btn-info m-1 font-medium underline"
                                                wire:click="$dispatch('openModal', {component: 'item.edit-item', arguments: {item: {{ $item }} }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" class="w-5 h-5">
                                                    <path
                                                        d="m2.695 14.762-1.262 3.155a.5.5 0 0 0 .65.65l3.155-1.262a4 4 0 0 0 1.343-.886L17.5 5.501a2.121 2.121 0 0 0-3-3L3.58 13.419a4 4 0 0 0-.885 1.343Z" />
                                                </svg>
                                            </button>
                                            <button type="button"
                                                class="btn btn-info m-1 text-red-600 font-medium underline"
                                                wire:click="delete({{ $item->id }})"
                                                wire:confirm="Are you sure you want to delete this item?">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" class="w-5 h-5">
                                                    <path fill-rule="evenodd"
                                                        d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </x-table.tbody-cell>
                                    </x-table.row>
                                @empty
                                    <x-table.row class="bg-white dark:bg-gray-700 dark:text-white">
                                        <x-table.tbody-cell colspan="9" :item="__('No item found!!')" />
                                    </x-table.row>
                                @endforelse
                            </x-table.tbody>
                        </x-table>
                    </div>
                    <div>
                        {{ $items->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
