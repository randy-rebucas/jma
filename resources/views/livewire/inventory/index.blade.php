<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Inventories') }}
    </h2>
</x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="min-w-full">
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Manage Inventories') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __('Search Inventories.') }}
                        </p>
                    </header>
                    <div class="mt-6 space-y-6">

                        <div class="flex justify-between">
                            <x-text-input wire:model.live="search" class="py-2" type="search" :placeholder="__('Search Inventories...')" />
                        </div>

                        <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                            <x-table for="items">
                                <x-table.thead>
                                    <x-table.row class="dark:bg-gray-900 dark:text-gray-100">
                                        <x-table.thead-cell :title="__('Transaction Type')" class="text-left" />
                                        <x-table.thead-cell :title="__('Sold by')" class="text-left" />
                                        <x-table.thead-cell :title="__('Sold To')" class="text-left" />
                                        <x-table.thead-cell :title="__('Created')" class="text-center" />
                                        <x-table.thead-cell :title="__('Transaction Amount')" class="text-right" />
                                    </x-table.row>
                                </x-table.thead>
                                <x-table.tbody class="dark:border-gray-500">
                                    @forelse ($items as $item)
                                        <x-table.row class=" dark:bg-gray-700 dark:text-white"
                                            wire:loading.class="opacity-50">
                                            <x-table.tbody-cell :item="$item->transaction_type" class="uppercase" />
                                            <x-table.tbody-cell :item="$item->id" :action="true">
                                                {{ App\Models\User::getUserName($item->user_id) }}
                                            </x-table.tbody-cell>
                                            <x-table.tbody-cell :item="$item->id" :action="true">
                                                {{ App\Models\Customer::getCustomerName($item->customer_id) }}
                                            </x-table.tbody-cell>
                                            <x-table.tbody-cell :item="$item->created_at" :action="true"
                                                class="text-center">
                                                {{ \Carbon\Carbon::parse($item->created_at)->format('M d,Y') }}
                                            </x-table.tbody-cell>
                                            <x-table.tbody-cell :item="number_format($item->transaction_total_amount, 2)" class="text-right"
                                                :action="true">
                                                {{ Number::currency($item->transaction_total_amount, 'PHP') }}
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
                        <div>
                            {{ $items->links() }}
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
