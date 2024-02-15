<x-modal form-action="update">
    <x-slot name="title">
        Update Supplier
    </x-slot>
    <fieldset class="border-2 border-double border-gray-200 p-4 rounded-md">
        <legend class="px-2">Personal Details</legend>
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
        <div class="flex justify-between mt-4 gap-4">
            <div class="w-1/2">
                <x-input-label for="phone_number" :value="__('Phone Number')" />
                <x-text-input wire:model="phone_number" id="phone_number" class="block mt-1 w-full" type="text"
                    name="phone_number" />
                <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
            </div>
            <div class="w-1/2">
                <x-input-label for="company_name" :value="__('Company Name')" />
                <x-text-input wire:model="company_name" id="company_name" class="block mt-1 w-full" type="text"
                    name="company_name" />
                <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
            </div>
        </div>
        <div class="mt-4">
            <x-input-label for="comments" :value="__('Comments')" />
            <x-textarea wire:model="comments" class="w-full" />
        </div>
    </fieldset>

    <x-slot name="buttons">
        <div class="flex items-center justify-end mt-4">
            <x-secondary-button class="ms-3" wire:click="$dispatch('closeModal')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button class="ms-3" wire:loading.attr="disabled">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </x-slot>
</x-modal>
