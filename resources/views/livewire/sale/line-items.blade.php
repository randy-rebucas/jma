<div>
    @if ($content->count() > 0)
        <x-table for="items">
            <x-table.thead>
                <x-table.row class="dark:bg-gray-900 dark:text-gray-100">
                    <x-table.thead-cell title="Name" class="text-left" />
                    <x-table.thead-cell title="Price" class="text-right" />
                    <x-table.thead-cell title="Quantity" class="text-center" />
                    <x-table.thead-cell title="Sub Total" class="text-right" />
                    <x-table.thead-cell title="Actions" class="text-right" />
                </x-table.row>
            </x-table.thead>
            <x-table.tbody class="dark:border-gray-500">
                @foreach ($content as $i => $item)
                    <x-table.row class="bg-white dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
                        <x-table.tbody-cell :item="$item->get('name')" />
                        <x-table.tbody-cell :item="number_format($item->get('price'), 2)" class="text-right" />
                        <x-table.tbody-cell :item="$item->get('quantity')" class="text-center" />
                        <x-table.tbody-cell :item="number_format($item->get('price') * $item->get('quantity'), 2)" class="text-right" />
                        <x-table.tbody-cell :item="$i" class="text-right" :action="true">
                            <button type="button" class="btn btn-info m-1 text-red-600 font-medium underline"
                                wire:click="removeFromCart({{ $i }})">Delete</button>
                        </x-table.tbody-cell>
                    </x-table.row>
                @endforeach
            </x-table.tbody>
        </x-table>
    @else
        <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3 rounded m-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z"/></svg>
            <p>Start typing on the box or scan the item.</p>
          </div>
    @endif
</div>
