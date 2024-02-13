<x-modal form-action="delete">
    <x-slot name="title">
        Confirm Deletion Customer
    </x-slot>
    <fieldset class="border-2 border-double border-gray-200 p-4 rounded-md">
        <legend class="px-2">Personal Details</legend>
        {{ $customer->first_name . ', ' . $customer->last_name }}
    </fieldset>
    <x-slot name="buttons">
        <div class="flex items-center justify-end mt-4">
            <x-secondary-button class="ms-3" wire:click="$dispatch('modal.close')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-primary-button class="ms-3 bg-red-600">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </x-slot>
</x-modal>
