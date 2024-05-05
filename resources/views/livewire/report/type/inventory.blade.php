<section>
    <header class="relative">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('View Report') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Select a date start and end to view report.') }}
        </p>
        <div class="absolute right-0 text-2xl top-2">
            <p>{{ __('Total:') }} @currency($grandTotal)</p>
        </div>
    </header>
    @if (isset($sales))
        <h2 class="my-3">Sales</h2>
        <div class="mt-4 align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
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
                    @forelse ($sales as $sale)
                        <x-table.row class=" dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
                            <x-table.tbody-cell :item="$sale->customer->full_name" />
                            <x-table.tbody-cell :item="$sale->created_at" :action="true">
                                @datetime($sale->created_at)
                            </x-table.tbody-cell>
                            <x-table.tbody-cell :item="$sale->sale_payment->payment_type" class="uppercase text-center" />
                            <x-table.tbody-cell :item="$sale->sale_payment->payment_amount" :action="true" class="text-right font-semibold">
                                @currency($sale->sale_payment->payment_amount)
                            </x-table.tbody-cell>
                        </x-table.row>
                    @empty
                        <x-table.row class="bg-white dark:bg-gray-700 dark:text-white">
                            <x-table.tbody-cell colspan="9" :item="__('No sale found!!')" />
                        </x-table.row>
                    @endforelse
                </x-table.tbody>
                <x-table.tfoot>
                    <x-table.row class=" dark:bg-gray-700 dark:text-white">
                        <x-table.thead-cell colspan="3" :title="__('Total Sales:')" class="text-right" />
                        <x-table.tfoot-cell :item="$totalSales" :action="true" class="text-right font-semibold">
                            @currency($totalSales)
                        </x-table.tfoot-cell>
                    </x-table.row>
                </x-table.tfoot>
            </x-table>
        </div>
    @endif

    @if (isset($jobs))
        <h2 class="my-3">Jobs</h2>
        <div class="mt-4 align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
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
                    @forelse ($jobs as $job)
                        <x-table.row class=" dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
                            <x-table.tbody-cell :item="$job->customer->full_name" />
                            <x-table.tbody-cell :item="$job->created_at" :action="true">
                                @datetime($job->created_at)
                            </x-table.tbody-cell>
                            <x-table.tbody-cell :item="$job->job_payment->payment_type" class="uppercase text-center" />
                            <x-table.tbody-cell :item="$job->total_amount" :action="true" class="text-right font-semibold">
                                @currency($job->total_amount)
                            </x-table.tbody-cell>
                        </x-table.row>
                    @empty
                        <x-table.row class="bg-white dark:bg-gray-700 dark:text-white">
                            <x-table.tbody-cell colspan="9" :item="__('No job found!!')" />
                        </x-table.row>
                    @endforelse
                </x-table.tbody>
                <x-table.tfoot>
                    <x-table.row class=" dark:bg-gray-700 dark:text-white">
                        <x-table.thead-cell colspan="3" :title="__('Total Jobs:')" class="text-right" />
                        <x-table.tfoot-cell :item="$totalJobs" :action="true" class="text-right font-semibold">
                            @currency($totalJobs)
                        </x-table.tfoot-cell>
                    </x-table.row>
                </x-table.tfoot>
            </x-table>
        </div>
    @endif

    @if (isset($expenses))
        <h2 class="my-3">Expenses</h2>
        <div class="mt-4 align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
            <x-table for="expenses">
                <x-table.thead>
                    <x-table.row class="dark:bg-gray-900 dark:text-gray-100">
                        <x-table.thead-cell :title="__('Name')" class="text-left" />
                        <x-table.thead-cell :title="__('Date')" class="text-left" />
                        <x-table.thead-cell :title="__('Description')" class="text-left" />
                        <x-table.thead-cell :title="__('Amount')" class="text-right" />
                    </x-table.row>
                </x-table.thead>
                <x-table.tbody class="dark:border-gray-500">
                    @forelse ($expenses as $expense)
                        <x-table.row class=" dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
                            <x-table.tbody-cell :item="$expense->name" />
                            <x-table.tbody-cell :item="$expense->created_at" :action="true">
                                @datetime($expense->created_at)
                            </x-table.tbody-cell>
                            <x-table.tbody-cell :item="$expense->description" />
                            <x-table.tbody-cell :item="$expense->amount" :action="true" class="text-right font-semibold">
                                @currency($expense->amount)
                            </x-table.tbody-cell>
                        </x-table.row>
                    @empty
                        <x-table.row class="bg-white dark:bg-gray-700 dark:text-white">
                            <x-table.tbody-cell colspan="9" :item="__('No expense found!!')" />
                        </x-table.row>
                    @endforelse

                </x-table.tbody>
                <x-table.tfoot>
                    <x-table.row class=" dark:bg-gray-700 dark:text-white">
                        <x-table.thead-cell colspan="3" :title="__('Total Expenses:')" class="text-right" />
                        <x-table.tfoot-cell :item="$totalExpenses" :action="true" class="text-right font-semibold">
                            @currency($totalExpenses)
                        </x-table.tfoot-cell>
                    </x-table.row>
                </x-table.tfoot>
            </x-table>
        </div>
    @endif
</section>
