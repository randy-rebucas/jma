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
                            class="dark:text-gray-200 text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ $total_jobs }}</span>
                        <h3 class="text-base font-normal text-gray-500">Total Jobs (current month)</h3>
                    </div>
                    <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                        14.6%
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="dark:bg-gray-800 bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span
                            class="dark:text-gray-200 text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ $total_sales }}</span>
                        <h3 class="text-base font-normal text-gray-500">Total Sales (current month)</h3>
                    </div>
                    <div class="ml-5 w-0 flex items-center justify-end flex-1 text-green-500 text-base font-bold">
                        32.9%
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 5.414V17a1 1 0 11-2 0V5.414L6.707 7.707a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="dark:bg-gray-800 bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 ">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <span
                            class="dark:text-gray-200 text-2xl sm:text-3xl leading-none font-bold text-gray-900">{{ $total_receivings }}</span>
                        <h3 class="text-base font-normal text-gray-500">Total Receivings (current month)</h3>
                    </div>
                    <div class="ml-5 w-0 flex items-center justify-end flex-1 text-red-500 text-base font-bold">
                        -2.7%
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M14.707 12.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 14.586V3a1 1 0 012 0v11.586l2.293-2.293a1 1 0 011.414 0z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="dark:bg-gray-800 bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 mt-4">

            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h3 class="dark:text-gray-200 text-xl font-bold text-gray-900 mb-2">Latest Transactions</h3>
                    <span class="text-base font-normal text-gray-500">This is a list of latest transactions</span>
                </div>
                <div class="flex-shrink-0">
                    <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View
                        all</a>
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
                                            Transaction
                                        </th>
                                        <th scope="col"
                                            class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Date &amp; Time
                                        </th>
                                        <th scope="col"
                                            class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Amount
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
                                                {{ number_format($inventory->transaction_total_amount, 2) }}
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
