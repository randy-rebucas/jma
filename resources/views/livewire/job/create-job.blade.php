<x-modal form-action="submit">
    <x-slot name="title">
        Create new Job
    </x-slot>
    <fieldset class="border-2 border-double border-gray-200 p-4 rounded-md">
        <legend class="px-2">Job Details</legend>
        <div>
            <x-input-label for="job_number" :value="__('Job Number')" />
            <x-text-input wire:model="job_number" id="job_number" class="block mt-1 w-full" type="text" name="job_number"
                readonly />
            <x-input-error :messages="$errors->get('job_number')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="type" :value="__('Type')" />
            <x-select wire:model="type" id="type" name="type" :options="$types" class="block mt-1 w-full"
                :selectedOptions="$selected" />
            <x-input-error :messages="$errors->get('type')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="customer" :value="__('Customer')" />
            <x-text-input wire:model="customer" id="customer" class="block mt-1 w-full" type="text"
                name="customer" />
            <x-input-error :messages="$errors->get('customer')" class="mt-2" />
        </div>
    </fieldset>

    <x-slot name="buttons">
        <div class="flex items-center justify-end mt-4">
            <x-secondary-button class="ms-3" wire:click="$dispatch('modal.close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button class="ms-3">
                {{ __('Submit') }}
            </x-primary-button>
        </div>
    </x-slot>
</x-modal>
