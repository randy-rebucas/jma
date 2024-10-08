<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Job Histories') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('List of all histories being worked on by the company.') }}
        </p>
    </header>
    <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
        @forelse ($jobs as $job)
            <x-table for="job">
                <x-table.tbody class="dark:border-gray-500">
                    <x-table.row class="bg-white dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
                        <x-table.thead-cell :title="__('Job Type')" class="text-left" />
                        <x-table.tbody-cell :item="$job->job_type" class="text-left text-green-600 uppercase" colspan="2" />
                        <x-table.thead-cell :title="__('Created')" class="text-left" />
                        <x-table.tbody-cell :item="$job->created_at" class="text-left text-green-600" :action="true"
                            colspan="2">
                            @datetime($job->created_at)
                        </x-table.tbody-cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.thead-cell :title="__('Payment Type')" class="text-left" />
                        <x-table.tbody-cell :item="$job->job_payment->payment_type" class="text-left uppercase text-green-600" colspan="2" />
                        <x-table.thead-cell :title="__('Status')" class="text-left " />
                        <x-table.tbody-cell :item="$job->paid ? 'Paid' : 'Unpaid'" class="text-left uppercase text-green-600" colspan="2" />
                    </x-table.row>
                    <x-table.row class="bg-white dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
                        <x-table.thead-cell :title="__('Items')" class="text-left" />
                        <x-table.tbody-cell :item="$job->id" class="" :action="true" colspan="5">
                            <table class="divide-cool-gray-200 divide-y min-w-full">
                                <thead>
                                    <tr>
                                        <th class="text-left">{{ __('Name') }}</th>
                                        <th class="text-center">{{ __('Quantity') }}</th>
                                        <th class="text-right">{{ __('Unit Price') }}</th>
                                        <th class="text-right">{{ __('Sub Total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($job->job_items as $job_items)
                                        <tr>
                                            <td class="text-left">{{ $job_items->item->name }}</td>
                                            <td class="text-center">{{ $job_items->quantity }}</td>
                                            <td class="text-right">
                                                @currency($job_items->unit_price)
                                            </td>
                                            <td class="text-right">
                                                @currency($job_items->sub_total)
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </x-table.tbody-cell>
                    </x-table.row>
                    <x-table.row class="bg-white dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
                        <x-table.thead-cell :title="__('Scope of Works')" class="text-left" />
                        <x-table.tbody-cell :item="$job->id" class="" :action="true" colspan="5">
                            <table class="divide-cool-gray-200 divide-y min-w-full">
                                <thead>
                                    <tr>
                                        <th class="text-left">{{ __('Name') }}</th>
                                        <th class="text-center">{{ __('Quantity') }}</th>
                                        <th class="text-right">{{ __('Unit Price') }}</th>
                                        <th class="text-right">{{ __('Sub Total') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($job->job_scope_of_works as $job_scope_of_work)
                                        <tr>
                                            <td class="text-left">{{ $job_scope_of_work->name }}</td>
                                            <td class="text-center">{{ $job_scope_of_work->quantity }}</td>
                                            <td class="text-right">
                                                @currency($job_scope_of_work->unit_price)
                                            </td>
                                            <td class="text-right">
                                                @currency($job_scope_of_work->sub_total)
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </x-table.tbody-cell>
                    </x-table.row>
                    <x-table.row>
                        <x-table.thead-cell :title="__('Total Amount')" class="text-left" />
                        <x-table.tbody-cell :item="$job->total_amount" class=" text-green-600 text-right text-xl"
                            :action="true" colspan="5">
                            @currency($job->total_amount)
                        </x-table.tbody-cell>
                    </x-table.row>
                </x-table.tbody>
            </x-table>
        @empty
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3 rounded m-3"
                role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path
                        d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                </svg>
                <p>{{ __('No job histories!') }}</p>
            </div>
        @endforelse
    </div>
</section>
