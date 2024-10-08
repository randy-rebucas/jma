<x-modal form-action="submit">
    <x-slot name="title">
        {{ __('Create new Address') }}
    </x-slot>

    <div class="w-full">
        <x-input-label for="line_1" :value="__('Line 1')" />
        <x-text-input wire:model="line_1" id="line_1" class="block mt-1 w-full" type="text" name="line_1" autofocus />
        <x-input-error :messages="$errors->get('line_1')" class="mt-2" />
    </div>

    <div class="w-full mt-4">
        <x-input-label for="line_2" :value="__('Line 2')" />
        <x-text-input wire:model="line_2" id="line_2" class="block mt-1 w-full" type="text" name="line_2" />
        <x-input-error :messages="$errors->get('line_2')" class="mt-2" />
    </div>

    <div class="flex justify-between gap-4 mt-4">
        <div class="w-1/3">
            <x-input-label for="district" :value="__('District')" />
            <x-text-input wire:model="district" id="district" class="block mt-1 w-full" type="text"
                name="district" />
            <x-input-error :messages="$errors->get('district')" class="mt-2" />
        </div>
        <div class="w-1/3">
            <x-input-label for="city_id" :value="__('City')" />
            <x-select wire:model="city_id" id="city_id" name="city_id" :options="$cities" class="block mt-1 w-full" />
            <x-input-error :messages="$errors->get('city_id')" class="mt-2" />
        </div>
        <div class="w-1/3">
            <x-input-label for="postal_code" :value="__('Postal Code')" />
            <x-text-input wire:model="postal_code" id="postal_code" class="block mt-1 w-full" type="text"
                name="postal_code" />
            <x-input-error :messages="$errors->get('postal_code')" class="mt-2" />
        </div>
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
