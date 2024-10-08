<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Addresses') }}
        </h2>
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('List of customer addresses.') }}
        </p>
    </header>
    <div class="mt-6 space-y-6">
        <x-table for="addresses">
            <x-table.thead>
                <x-table.row class="dark:bg-gray-900 dark:text-gray-100">
                    <x-table.thead-cell :title="__('Line 1')" class="text-left" />
                    <x-table.thead-cell :title="__('Line 2')" class="text-left" />
                    <x-table.thead-cell :title="__('District')" class="text-left" />
                    <x-table.thead-cell :title="__('City')" class="text-left" />
                    <x-table.thead-cell :title="__('Country')" class="text-left" />
                    <x-table.thead-cell :title="__('Postal Code')" class="text-left" />
                    <x-table.thead-cell title="" :action="true" class="text-right">
                        <button type="button" class="btn btn-info m-1 font-medium underline"
                            wire:click="$dispatch('openModal', { component: 'customer.address.create-address', arguments: {customer: {{ $customer->id }}} })">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </x-table.thead-cell>
                </x-table.row>
            </x-table.thead>
            <x-table.tbody class="dark:border-gray-500">
                @forelse ($addresses as $item)
                    <x-table.row class="bg-white dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
                        <x-table.tbody-cell :item="$item->address->line_1" />
                        <x-table.tbody-cell :item="$item->address->line_2" />
                        <x-table.tbody-cell :item="$item->address->district" />
                        <x-table.tbody-cell :item="$item->address->city->name" />
                        <x-table.tbody-cell :item="$item->address->city->country->name" />
                        <x-table.tbody-cell :item="$item->address->postal_code" />
                        <x-table.tbody-cell :item="$item->id" class="text-right md:py-1" :action="true">
                            <button type="button" class="btn btn-info m-1 text-red-600 font-medium underline"
                                wire:click="delete('{{ $item->id }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                            </button>
                        </x-table.tbody-cell>
                    </x-table.row>
                @empty
                    <x-table.row class="bg-white dark:bg-gray-700 dark:text-white text-center">
                        <x-table.tbody-cell colspan="7" :item="__('No address found!!')" />
                    </x-table.row>
                @endforelse
            </x-table.tbody>
        </x-table>
    </div>
</section>
