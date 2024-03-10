<x-modal form-action="submit">
    <x-slot name="title">
        {{ __('Scope of works') }}
    </x-slot>

    <div>
        <x-input-label for="scope_name" :value="__('Scope Name')" />
        <x-textarea wire:model="scope_name" class="w-full" />
        <x-input-error :messages="$errors->get('scope_name')" class="mt-2" />
    </div>
    <div class="mt-2">
        <x-input-label for="scope_amount" :value="__('Amount')" />
        <x-text-input wire:model="scope_amount" id="scope_amount" class="block mt-1 w-full" type="number"
            name="scope_amount" />
        <x-input-error :messages="$errors->get('scope_amount')" class="mt-2" />
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
