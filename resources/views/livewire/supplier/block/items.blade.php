<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Linked Items') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('This are all linked items.') }}
        </p>
    </header>
    <div class="mt-6 space-y-6">
        <x-table for="items">
            <x-table.thead>
                <x-table.row class="dark:bg-gray-900 dark:text-gray-100">
                    <x-table.thead-cell :title="__('Name')" class="text-left" />
                    <x-table.thead-cell :title="__('Category')" class="text-left" />
                    <x-table.thead-cell :title="__('ReOrder Level')" class="text-center" />
                    <x-table.thead-cell :title="__('Quantity Stocks')" class="text-center" />
                    <x-table.thead-cell :title="__('Price')" class="text-right" />
                    <x-table.thead-cell title="" class="text-right" />
                </x-table.row>
            </x-table.thead>
            <x-table.tbody class="dark:border-gray-500">
                @forelse ($items as $item)
                    @php
                        switch (true) {
                            case $item->receiving_quantity < $item->reorder_level && $item->receiving_quantity > 1:
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
                        <x-table.tbody-cell :item="$item->name" />
                        <x-table.tbody-cell :item="$item->category->name" />
                        <x-table.tbody-cell :item="$item->reorder_level" class="text-center" />
                        <x-table.tbody-cell :item="$item->receiving_quantity" class="text-center" />
                        <x-table.tbody-cell :item="$item->format_price" :action="true" class="text-right">
                            @currency($item->price)
                        </x-table.tbody-cell>
                        <x-table.tbody-cell :item="$item->id" :action="true" class="text-right">
                            <button type="button" class="btn btn-info m-1 font-medium underline"
                                wire:click="$dispatch('openModal', {component: 'item.edit-item', arguments: {item: {{ $item }} }})">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5">
                                    <path
                                        d="m2.695 14.762-1.262 3.155a.5.5 0 0 0 .65.65l3.155-1.262a4 4 0 0 0 1.343-.886L17.5 5.501a2.121 2.121 0 0 0-3-3L3.58 13.419a4 4 0 0 0-.885 1.343Z" />
                                </svg>
                            </button>
                            <button type="button" class="btn btn-info m-1 text-red-600 font-medium underline"
                                wire:click="delete({{ $item->id }})"
                                wire:confirm="Are you sure you want to delete this item?">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5">
                                    <path fill-rule="evenodd"
                                        d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-table.tbody-cell>
                    </x-table.row>
                @empty
                    <x-table.row class="bg-white dark:bg-gray-700 dark:text-white">
                        <x-table.tbody-cell colspan="9" :item="'No item found!!'" />
                    </x-table.row>
                @endforelse
            </x-table.tbody>
        </x-table>
    </div>
</section>
