<x-slot name="header">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Manage Sales') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Search and Generate sales report.') }}
    </p>
</x-slot>


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
                    <x-table.thead-cell :title="__('Sale Type')" class="text-left" />
                    <x-table.thead-cell :title="__('Customer')" class="text-left" />
                    <x-table.thead-cell :title="__('Date')" class="text-left" />
                    <x-table.thead-cell :title="__('Payment Type')" class="text-center" />
                    <x-table.thead-cell :title="__('Amount')" class="text-right" />
                </x-table.row>
            </x-table.thead>
            <x-table.tbody class="dark:border-gray-500">
                @forelse ($items as $item)
                    <x-table.row class=" dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
                        <x-table.tbody-cell :item="$item->sale_type" class="uppercase" />
                        <x-table.tbody-cell :item="$item->customer->full_name" />
                        <x-table.tbody-cell :item="$item->created_at" :action="true">
                            @datetime($item->created_at)
                        </x-table.tbody-cell>
                        <x-table.tbody-cell :item="$item->sale_payment->payment_type" class="uppercase text-center" />
                        <x-table.tbody-cell :item="$item->sale_payment->payment_amount" :action="true" class="text-right font-semibold">
                            @currency($item->sale_payment->payment_amount)
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
