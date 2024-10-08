<x-modal form-action="submit">
    <x-slot name="title">
        {{ __('Assign a Role') }}
    </x-slot>
    <div class="w-full mt-4">
        <x-input-label for="role" :value="__('Role')" />
        <x-select wire:model="role" id="role" name="role" :options="$roles" class="block mt-1 w-full" />
        <x-input-error :messages="$errors->get('role')" class="mt-2" />
    </div>
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
