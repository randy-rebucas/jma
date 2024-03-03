<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Job Registered') }}
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
                                        <x-table.thead-cell :title="__('Type')" class="text-left" />
                                        <x-table.thead-cell :title="__('Customer')" class="text-left" />
                                        <x-table.thead-cell :title="__('Amount')" class="text-left" />
                                        <x-table.thead-cell :title="__('Amount')" class="text-right" />
                                        <x-table.thead-cell :title="__('Date')" class="text-left" />
                                    </x-table.row>
                                </x-table.thead>
                                <x-table.tbody class="dark:border-gray-500">
                                    @forelse ($items as $item)
                                        <x-table.row class=" dark:bg-gray-700 dark:text-white"
                                            wire:loading.class="opacity-50">
                                            <x-table.tbody-cell :item="$item->job_type" class="uppercase" />
                                            <x-table.tbody-cell :item="$item->customer->full_name" />
                                            <x-table.tbody-cell :item="$item->job_payment->payment_amount" />
                                            <x-table.tbody-cell :item="$item->created_at" :action="true">
                                                {{ \Carbon\Carbon::parse($item->created_at)->format('M d,Y') }}
    
                                            <x-table.tbody-cell :item="number_format($item->job_item->total_amount, 2)" class="text-right" />
                                                <x-table.tbody-cell :item="$item->job_paymnent->payment_amount" :action="true"
                                                    class="text-right font-semibold">
                                                    {{ Number::currency($item->job_item->total_amount, 'PHP') }}
                                                </x-table.tbody-cell>
                                        </x-table.row>
                                        {{-- <x-table.row class=" dark:bg-gray-700 dark:text-white"
                                            wire:loading.class="opacity-50">
                                            <x-table.tbody-cell colspan="9" :action="true" :item="$item->id">
                                                @php
                                                    $scopes = json_decode($item->job_scope_of_works->scopes);
                                                @endphp
                                                @foreach ($scopes as $key => $scope_item)
                                                    {{ $scope_item->name }} :  {{ $scope_item->price }}
                                                @endforeach
                                            </x-table.tbody-cell>
                                        </x-table.row> --}}
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
