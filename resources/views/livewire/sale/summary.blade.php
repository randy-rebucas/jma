<div>
    <fieldset class="border-2 border-double border-gray-200 p-4 rounded-md">
        <legend class="px-2">{{ __('Select Customer') }}</legend>
        {{-- <x-text-input wire:model="customer" id="customer" class="block w-full" type="text" name="customer" /> --}}
        <div class="relative w-full">
            <x-text-input wire:model.debounce.500ms="search" wire:keyup="searchResult" wire:keydown.enter="searchResult"
                class="w-full" type="text" placeholder="Find customer..." />

            <!-- Search result list -->
            @if (!empty($records))
                <ul class="absolute bottom-0 list-none overflow-visible top-12 w-full">
                    @foreach ($records as $record)
                        <li wire:click="setCustomer({{ $record->id }})"
                            class="bg-indigo-50 p-2 hover:cursor-pointer hover:bg-slate-100">
                            {{ $record->first_name . ' ' . $record->last_name }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <div class="flex items-center justify-center mt-2">
            <p class="text-gray-400 text-sm">or</p>
            <x-secondary-button class="ms-3 py-3"
                wire:click="$dispatch('openModal', { component: 'customer.create-customer' })">
                {{ __('Create customer') }}
            </x-secondary-button>
        </div>

        @if (!empty($details))
            <p class="bg-slate-200 mt-2 p-2"> Name : {{ $details->first_name . ' ' . $details->last_name }}</p>
        @endif
    </fieldset>
    <fieldset class="border-2 border-double border-gray-200 p-4 rounded-md mt-2">
        <legend class="px-2">Summary</legend>
        <ul class="list-none">
            <li>Quantity <span class="float-right">{{ $totalQuantity }}</span></li>
            <li class="text-2xl">Total <span class="float-right">{{ $total }}</span></li>
        </ul>
    </fieldset>
    <fieldset class="border-2 border-double border-gray-200 p-4 rounded-md mt-2">
        <legend class="px-2">Payments {{$mode}}</legend>
        <div class="flex items-center justify-between w-full">
            <x-input-label for="type" :value="__('Type')" />
            <x-select wire:model="type" id="type" name="type" :options="$types" class="mt-1 w-1/2" />
        </div>
        <div class="flex items-center justify-between w-full">
            <x-input-label for="amount" :value="__('Amount')" />
            <x-text-input wire:model="amount" id="amount" class="mt-1 w-1/2" type="number" name="amount" />
        </div>
        <div class="mt-2">
            <x-input-error :messages="$errors->get('type')" />
            <x-input-error :messages="$errors->get('amount')" />
        </div>
    </fieldset>
    <div class="flex justify-between mt-2">
        <x-secondary-button class="py-3 my-2"
            wire:click="$dispatch('openModal', { component: 'customer.create-customer' })">
            {{ __('Suspend') }}
        </x-secondary-button>
        <x-secondary-button class="py-3 my-2" wire:click="doComplete">
            {{ __('Complete') }}
        </x-secondary-button>
    </div>
</div>
