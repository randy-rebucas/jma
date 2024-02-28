<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Receiving Registered') }}
    </h2>
</x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="min-w-full">
                <section>
                    <div class="space-y-6">

                        <div class="flex justify-between">
                            <x-text-input wire:model.live="search" class="py-2" type="search" :placeholder="__('Search Items...')" />
                            <div>
                                <x-secondary-button class="ms-3 mx-3" wire:click="registerView">
                                    {{ __('Register') }}
                                </x-secondary-button>
                            </div>
                        </div>

                        <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                            <x-table for="jobs">
                                <x-table.thead>
                                    <x-table.row class="dark:bg-gray-900 dark:text-gray-100">
                                        <x-table.thead-cell :title="__('Receiving Type')" class="text-left" />
                                        <x-table.thead-cell :title="__('Supplier')" class="text-left" />
                                        <x-table.thead-cell :title="__('Serial')" class="text-left" />
                                        <x-table.thead-cell :title="__('Payment Type')" class="text-left" />
                                        <x-table.thead-cell :title="__('Amount')" class="text-right" />
                                    </x-table.row>
                                </x-table.thead>
                                <x-table.tbody class="dark:border-gray-500">
                                    @forelse ($items as $item)
                                        <x-table.row class=" dark:bg-gray-700 dark:text-white"
                                            wire:loading.class="opacity-50">
                                            <x-table.tbody-cell :item="$item->receiving_type" class="uppercase" />
                                            <x-table.tbody-cell :item="$item->supplier->full_name" />
                                            <x-table.tbody-cell :item="$item->serial" />
                                            <x-table.tbody-cell :item="$item->receiving_payment->payment_type" class="uppercase" />
                                            <x-table.tbody-cell :item="number_format($item->receiving_payment->payment_amount, 2)" class="text-right" />
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
