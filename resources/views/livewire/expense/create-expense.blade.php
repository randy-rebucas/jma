<x-modal form-action="submit">
    <x-slot name="title">
        {{ __('Create Expense') }}
    </x-slot>
    <fieldset class="border-2 border-double border-gray-200 p-4 rounded-md">
        <legend class="dark:text-gray-200 px-2">{{ __('Expense Details') }}</legend>
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="amount" :value="__('Amount')" />
            <x-text-input wire:model="amount" id="amount" class="block mt-1 w-full" type="number" name="amount" />
            <x-input-error :messages="$errors->get('amount')" class="mt-2" />
        </div>
        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <x-textarea wire:model="description" class="w-full" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
    </fieldset>
    <x-slot name="buttons">
        <div class="flex items-center justify-end">
            <x-secondary-button class="ms-3" wire:click="$dispatch('closeModal')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button class="ms-3" wire:loading.attr="disabled">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </x-slot>
</x-modal>
