<x-modal form-action="update">
    <x-slot name="title">
        Update Customer
    </x-slot>
    <fieldset class="border-2 border-double border-gray-200 p-4 rounded-md">
        <legend class="dark:text-gray-200 px-2">Personal Details</legend>
        <div class="flex justify-between gap-4">
            <div class="w-1/2">
                <x-input-label for="first_name" :value="__('First Name')" />
                <x-text-input wire:model="first_name" id="first_name" class="block mt-1 w-full" type="text"
                    name="first_name" autofocus />
                <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
            </div>

            <div class="w-1/2">
                <x-input-label for="last_name" :value="__('Last Name')" />
                <x-text-input wire:model="last_name" id="last_name" class="block mt-1 w-full" type="text"
                    name="last_name" />
                <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="phone_number" :value="__('Phone Number')" />
            <x-text-input wire:model="phone_number" id="phone_number" class="block mt-1 w-full" type="text"
                name="phone_number" />
            <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
        </div>
    </fieldset>
    <x-slot name="buttons">
        <div class="flex items-center justify-end">
            <x-secondary-button class="ms-3" wire:click="$dispatch('closeModal')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button class="ms-3">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </x-slot>
</x-modal>
