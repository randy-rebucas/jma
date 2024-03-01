<x-slot name="header">
    <livewire:global-search />
</x-slot>

<div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mt-4 w-full grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
            <div class="dark:bg-gray-800 bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span
                            class="dark:text-gray-200 text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ Number::format($total_jobs) }}</span>
                        <h3 class="text-base font-normal text-gray-500">{{ __('Total Jobs (current month)') }}</h3>
                    </div>
                    {{-- <livewire:shared.calc-percentage :total="$total_jobs" model="job" /> --}}
                </div>
            </div>
            <div class="dark:bg-gray-800 bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span
                            class="dark:text-gray-200 text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ Number::format($total_sales) }}</span>
                        <h3 class="text-base font-normal text-gray-500">{{ __('Total Sales (current month)') }}</h3>
                    </div>
                    {{-- <livewire:shared.calc-percentage :total="$total_sales" model="sale" /> --}}
                </div>
            </div>
            <div class="dark:bg-gray-800 bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span
                            class="dark:text-gray-200 text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ Number::format($total_receivings) }}</span>
                        <h3 class="text-base font-normal text-gray-500">{{ __('Total Receivings (current month)') }}
                        </h3>
                    </div>
                    {{-- <livewire:shared.calc-percentage :total="$total_receivings" model="receiving" /> --}}

                </div>
            </div>
        </div>

        <div class="dark:bg-gray-800 bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 mt-4">

            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h3 class="dark:text-gray-200 text-xl font-bold text-gray-900 mb-2">{{ __('Latest Transactions') }}
                    </h3>
                    <span
                        class="text-base font-normal text-gray-500">{{ __('This is a list of latest transactions') }}</span>
                </div>
                <div class="flex-shrink-0">
                    <a wire:navigate href="{{ route('inventories') }}"
                        class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">{{ __('View all') }}</a>
                </div>
            </div>

            <div class="flex flex-col mt-8">
                <div class="overflow-x-auto rounded-lg">
                    <div class="align-middle inline-block min-w-full">
                        <div class="shadow overflow-hidden sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50  dark:bg-gray-900 dark:text-gray-100">
                                    <tr>
                                        <th scope="col"
                                            class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Transaction') }}
                                        </th>
                                        <th scope="col"
                                            class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Date &amp; Time') }}
                                        </th>
                                        <th scope="col"
                                            class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Amount') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventories as $inventory)
                                        <tr class="dark:bg-gray-700">
                                            <td
                                                class="dark:text-gray-200 p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                                                ({{ $inventory->transaction_type != 'receive' ? 'Payment from ' : 'Payment sent ' }})
                                                <span class="font-semibold">
                                                    {{ App\Models\Inventory::getCustomer($inventory->serial) }}
                                                </span>
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                                                {{ \Carbon\Carbon::parse($inventory->created_at)->format('M d,Y') }}
                                            </td>
                                            <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                                {{ Number::currency($inventory->transaction_total_amount, 'PHP') }}
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
