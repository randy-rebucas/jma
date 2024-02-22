<div>
    <div class="bg-slate-100 flex items-center justify-between mb-2 p-2">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Owned Address</h2>
        <x-secondary-button class="ms-3 py-3"
            wire:click="$dispatch('openModal', { component: 'customer.address.create-address', arguments: {customer: {{ $customer->id }}} })">
            {{ __('Create Address') }}
        </x-secondary-button>
    </div>
    <div class="flex gap-4">
        @forelse ($addresses as $i => $item)
            <div class="max-w-sm rounded overflow-hidden shadow-lg relative">
                <div class="px-6">
                    <div class="font-bold text-xl mb-2">
                        {{ __('Address') . ' ' . $i + 1}}
                        <button type="button"
                            class="absolute right-1 btn btn-info m-1 text-red-600 font-medium underline"
                            wire:click="delete({{ $item->id }})"
                            wire:confirm="Are you sure you want to delete this address?">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                    <address class="text-gray-700 text-lg">
                        {{ $item->address->line_1 }} {{ $item->address->line_2 }}, {{ $item->address->district }},
                        <br />
                        {{ $item->address->city->name }}, {{ $item->address->postal_code }}
                    </address>
                </div>
            </div>
        @empty
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3 rounded m-3 flex-1"
                role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path
                        d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                </svg>
                <p>{{ __('No address added.') }}</p>
            </div>
        @endforelse
    </div>
</div>
