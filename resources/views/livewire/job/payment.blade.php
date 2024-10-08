<div>
    @if ($total > 0)
        <fieldset class="border-2 border-double border-gray-200 pb-3 px-4 rounded-md">
            <legend class="px-2">{{ __('Payments') }}</legend>
            <div class="flex items-center justify-between w-full">
                <x-input-label for="type" :value="__('Type')" />
                <x-select wire:model="type" id="type" name="type" wire:change="changeType($event.target.value)"
                    :options="$types" class="mt-1 w-1/2" />
            </div>
            <div class="flex items-center justify-between w-full">
                <x-input-label for="amount" :value="__('Amount')" />
                <x-text-input wire:model="amount" id="amount" class="mt-1 w-1/2" type="number" name="amount" />
            </div>
            <div class="flex items-center justify-between w-full">
                <x-input-label for="discount" :value="__('Discount')" />
                <x-text-input wire:model="discount" id="discount" class="mt-1 w-1/2" type="number" name="discount" />
            </div>
            <div class="flex items-center justify-between w-full mt-3">
                <x-input-label for="paid" :value="__('Paid')" />
                <input value="1" wire:model="paid" id="paid" type="checkbox"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            </div>
            <div class="mt-2">
                <x-input-error :messages="$errors->get('type')" />
                <x-input-error :messages="$errors->get('amount')" />
                <x-input-error :messages="$errors->get('customer')" />
                <x-input-error :messages="$errors->get('car')" />
                <x-input-error :messages="$errors->get('mode')" />
            </div>
        </fieldset>
        <div class="flex justify-between mt-2">
            <x-secondary-button class="py-3 my-2" wire:click="doCanceled"
                wire:confirm="Are you sure you want to clear this sale? All items will be cleared.">
                {{ __('Cancel') }}
            </x-secondary-button>
            <x-secondary-button class="py-3 my-2 bg-green-700 hover:bg-green-800 hover:text-white"
                wire:click="doComplete">
                {{ __('Complete') }}
            </x-secondary-button>
        </div>
    @endif
</div>
