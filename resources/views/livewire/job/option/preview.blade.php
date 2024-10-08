<x-slot name="header">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Manage Jobs') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Search and Update Job Statuses.') }}
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
                    <x-table.thead-cell :title="__('Type')" class="text-left" />
                    <x-table.thead-cell :title="__('Customer')" class="text-left" />
                    <x-table.thead-cell :title="__('Date')" class="text-left" />
                    <x-table.thead-cell :title="__('Total Amount Due')" class="text-right" />
                    <x-table.thead-cell :title="__('Tendered Amount')" class="text-right" />
                    <x-table.thead-cell :title="__('Change')" class="text-right" />
                    <x-table.thead-cell :title="__('Status')" class="text-center" />
                    <x-table.thead-cell :title="__('Action')" class="text-center" />
                </x-table.row>
            </x-table.thead>
            <x-table.tbody class="dark:border-gray-500">
                @forelse ($items as $item)
                    <x-table.row class=" dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
                        <x-table.tbody-cell :item="$item->job_type" class="uppercase" />
                        <x-table.tbody-cell :item="$item->customer->full_name" />
                        <x-table.tbody-cell :item="$item->created_at" :action="true">
                            @datetime($item->created_at)
                        </x-table.tbody-cell>
                        <x-table.tbody-cell :item="$item->id" :action="true" class="text-right font-semibold">
                            @currency($item->total_amount)
                        </x-table.tbody-cell>
                        <x-table.tbody-cell :item="$item->id" :action="true" class="text-right font-semibold">
                            @currency($item->job_payment->tendered_amount)
                        </x-table.tbody-cell>
                        <x-table.tbody-cell :item="$item->id" :action="true" class="text-right font-semibold">
                            @currency($item->job_payment->change)
                        </x-table.tbody-cell>
                        <x-table.tbody-cell :item="$item->paid ? 'Paid' : 'Unpaid'" class="text-center" />
                        <x-table.tbody-cell :action="true" class="flex">
                            <button type="button" class="btn btn-info m-1 font-medium underline"
                                wire:click="update({{ $item->id }})"
                                wire:confirm="Are you sure you want to update this item to {{ $item->paid ? 'Unpaid' : 'Paid' }}?">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5">
                                    <path fill-rule="evenodd"
                                        d="M15.312 11.424a5.5 5.5 0 0 1-9.201 2.466l-.312-.311h2.433a.75.75 0 0 0 0-1.5H3.989a.75.75 0 0 0-.75.75v4.242a.75.75 0 0 0 1.5 0v-2.43l.31.31a7 7 0 0 0 11.712-3.138.75.75 0 0 0-1.449-.39Zm1.23-3.723a.75.75 0 0 0 .219-.53V2.929a.75.75 0 0 0-1.5 0V5.36l-.31-.31A7 7 0 0 0 3.239 8.188a.75.75 0 1 0 1.448.389A5.5 5.5 0 0 1 13.89 6.11l.311.31h-2.432a.75.75 0 0 0 0 1.5h4.243a.75.75 0 0 0 .53-.219Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </button>
                            <a href="{{ route('job-invoice', $item->id) }}" class="btn btn-info m-1 font-medium underline" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m9 14.25 6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0c1.1.128 1.907 1.077 1.907 2.185ZM9.75 9h.008v.008H9.75V9Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm4.125 4.5h.008v.008h-.008V13.5Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                            </a>
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
