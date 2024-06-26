<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Histories') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('This are all history transactions.') }}
        </p>
    </header>
    <div class="mt-6 space-y-6">
        <h3>Sales</h3>
        <x-table for="sales">
            <x-table.thead>
                <x-table.row class="dark:bg-gray-900 dark:text-gray-100">
                    <x-table.thead-cell :title="__('Created')" class="text-center" />
                    <x-table.thead-cell :title="__('Amount')" class="text-right" />
                    <x-table.thead-cell title="" class="text-right" />
                </x-table.row>
            </x-table.thead>
            <x-table.tbody class="dark:border-gray-500">
                @forelse ($sales as $sale)
                    <x-table.row class="bg-white dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
                        <x-table.tbody-cell :item="$sale->created_at" class="text-center" :action="true">
                            @datetime($sale->created_at)
                        </x-table.tbody-cell>
                        <x-table.tbody-cell :item="$sale->sale_payment->payment_amount" class="text-right" :action="true">
                            @currency($sale->sale_payment->payment_amount)
                        </x-table.tbody-cell>
                        <x-table.tbody-cell :item="$sale->id" class="text-right" :action="true">
                            <button type="button" class="btn btn-info m-1 font-medium underline"
                                wire:click="$dispatch('openModal', {component: 'inventory.detail', arguments: {sale: {{ $sale }} }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </x-table.tbody-cell>
                    </x-table.row>
                @empty
                    <x-table.row class="bg-white dark:bg-gray-700 dark:text-white text-center">
                        <x-table.tbody-cell colspan="6" :item="__('No sales transaction found!!')" />
                    </x-table.row>
                @endforelse
            </x-table.tbody>
        </x-table>
        <h3>Jobs</h3>
        <x-table for="jobs">
            <x-table.thead>
                <x-table.row class="dark:bg-gray-900 dark:text-gray-100">
                    <x-table.thead-cell :title="__('Created')" class="text-center" />
                    <x-table.thead-cell :title="__('Amount')" class="text-right" />
                    <x-table.thead-cell title="" class="text-right" />
                </x-table.row>
            </x-table.thead>
            <x-table.tbody class="dark:border-gray-500">
                @forelse ($jobs as $job)
                    <x-table.row class="bg-white dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
                        <x-table.tbody-cell :item="$job->created_at" class="text-center" :action="true">
                            @datetime($job->created_at)
                        </x-table.tbody-cell>
                        <x-table.tbody-cell :item="$job->job_payment->tendered_amount" class="text-right" :action="true">
                            @currency($job->job_payment->tendered_amount)
                        </x-table.tbody-cell>
                        <x-table.tbody-cell :item="$job->id" class="text-right" :action="true">
                            <button type="button" class="btn btn-info m-1 font-medium underline"
                                wire:click="$dispatch('openModal', {component: 'inventory.detail', arguments: {job: {{ $job }} }})">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </x-table.tbody-cell>
                    </x-table.row>
                @empty
                    <x-table.row class="bg-white dark:bg-gray-700 dark:text-white text-center">
                        <x-table.tbody-cell colspan="6" :item="__('No jobs transaction found!!')" />
                    </x-table.row>
                @endforelse
            </x-table.tbody>
        </x-table>
    </div>
</section>
