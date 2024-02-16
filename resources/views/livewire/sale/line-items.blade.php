<div>
    @if ($content->count() > 0)
        <x-table for="items">
            <x-table.thead>
                <x-table.row>
                    <x-table.thead-cell title="Name" class="text-left" />
                    <x-table.thead-cell title="Price" class="text-right" />
                    <x-table.thead-cell title="Quantity" class="text-center" />
                    <x-table.thead-cell title="Sub Total" class="text-right" />
                    <x-table.thead-cell title="Actions" class="text-right" />
                </x-table.row>
            </x-table.thead>
            <x-table.tbody>
                @foreach ($content as $i => $item)
                    <x-table.row class="bg-white" wire:loading.class="opacity-50">
                        <x-table.tbody-cell :item="$item->get('name')" />
                        <x-table.tbody-cell :item="number_format($item->get('price'), 2)" class="text-right"/>
                        <x-table.tbody-cell :item="$item->get('quantity')" class="text-center" />
                        <x-table.tbody-cell :item="number_format($item->get('price') * $item->get('quantity'), 2)" class="text-right"/>
                        <x-table.tbody-cell :item="$i" class="text-right" :action="true">
                            <button type="button" class="btn btn-info m-1 text-red-600 font-medium underline"
                                wire:click="removeFromCart({{ $i }})">Delete</button>
                        </x-table.tbody-cell>
                    </x-table.row>
                @endforeach
            </x-table.tbody>
        </x-table>
    @else
        <p class="text-left bg-green-200 p-2 rounded m-3">{{ __('No cart items.') }}</p>
    @endif
</div>
