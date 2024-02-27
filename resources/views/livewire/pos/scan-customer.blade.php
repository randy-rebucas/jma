<div>
    <fieldset class="border-2 border-double border-gray-200 pb-3 px-4 rounded-md">
        <legend class="px-2">{{ __('Select Customer') }}</legend>
        <div class="relative w-full">
            <x-text-input wire:model.debounce.500ms="search" wire:keyup="searchResult" wire:keydown.enter="searchResult"
                class="w-full" type="text" :placeholder="__('Find customer...')" />

            <!-- Search result list -->
            @if (!empty($records))
                <ul class="absolute bottom-0 list-none overflow-visible top-12 w-full">
                    @foreach ($records as $record)
                        <li wire:click="setCustomer({{ $record->id }})"
                            class="bg-indigo-50 dark:text-gray-800 hover:bg-slate-100 hover:cursor-pointer p-2">
                            {{ $record->first_name . ' ' . $record->last_name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="flex items-center justify-center mt-2">
            <p class="text-gray-400 text-sm">{{__('or')}}</p>
            <x-secondary-button class="ms-3 py-3"
                wire:click="$dispatch('openModal', { component: 'customer.create-customer' })">
                {{ __('Create customer') }}
            </x-secondary-button>
        </div>

        @if (!empty($details))
            <p class="bg-slate-200 dark:bg-gray-800/50 mt-2 p-2 rounded-lg"> {{ __('Name') }} :
                {{ $details->first_name . ' ' . $details->last_name }}</p>
        @endif
    </fieldset>
</div>
