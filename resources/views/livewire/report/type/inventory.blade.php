<section>
    <header class="relative">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('View Report') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Select a date start and end to view report.') }}
        </p>
        <div class="absolute right-0 text-2xl top-2">
            <p>{{ __('Total:') }} @currency($sum)</p>
        </div>
    </header>
    <div class="mt-4 align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
        @if (isset($items))
            <x-table for="sales">
                <x-table.thead>
                    <x-table.row class="dark:bg-gray-900 dark:text-gray-100">
                        <x-table.thead-cell :title="__('Customer')" class="text-left" />
                        <x-table.thead-cell :title="__('Date')" class="text-left" />
                        <x-table.thead-cell :title="__('Payment Type')" class="text-center" />
                        <x-table.thead-cell :title="__('Amount')" class="text-right" />
                    </x-table.row>
                </x-table.thead>
                <x-table.tbody class="dark:border-gray-500">


                    @forelse ($items as $item)
                        <x-table.row class=" dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
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
        @endif
    </div>
</section>
