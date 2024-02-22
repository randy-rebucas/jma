<x-modal form-action="submit">
    <x-slot name="title">
        {{ __('Create new Car') }}
    </x-slot>

    <div class="flex justify-between gap-4">
        <div class="w-1/2">
            <x-input-label for="brand" :value="__('Brand')" />
            <x-text-input wire:model="brand" id="brand" class="block mt-1 w-full" type="text" name="brand"
                autofocus />
            <x-input-error :messages="$errors->get('brand')" class="mt-2" />
        </div>

        <div class="w-1/2">
            <x-input-label for="model" :value="__('Model')" />
            <x-text-input wire:model="model" id="model" class="block mt-1 w-full" type="text"
                name="model" />
            <x-input-error :messages="$errors->get('model')" class="mt-2" />
        </div>
    </div>
    <div class="flex justify-between gap-4 mt-4">
        <div class="w-1/2">
            <x-input-label for="plate_number" :value="__('Plate Number')" />
            <x-text-input wire:model="plate_number" id="plate_number" class="block mt-1 w-full" type="text"
                name="plate_number" />
            <x-input-error :messages="$errors->get('plate_number')" class="mt-2" />
        </div>
        <div class="w-1/2">
            <x-input-label for="color" :value="__('Color')" />
            <x-text-input wire:model="color" id="color" class="block mt-1 w-full" type="text"
                name="color" />
            <x-input-error :messages="$errors->get('color')" class="mt-2" />
        </div>
    </div>
    <div class="flex justify-between gap-4 mt-4">
        <div class="w-1/2">
            <x-input-label for="odo_km" :value="__('ODO km')" />
            <x-text-input wire:model="odo_km" id="odo_km" class="block mt-1 w-full" type="text"
                name="odo_km" />
            <x-input-error :messages="$errors->get('odo_km')" class="mt-2" />
        </div>
        <div class="w-1/2">
            <x-input-label for="year" :value="__('Year')" />
            <x-text-input wire:model="year" id="year" class="block mt-1 w-full" type="text"
                name="year" />
            <x-input-error :messages="$errors->get('year')" class="mt-2" />
        </div>
    </div>
    <div class="flex justify-between gap-4 mt-4">
        <div class="w-1/2">
            <x-input-label for="engine_number" :value="__('Engine Number')" />
            <x-text-input wire:model="engine_number" id="engine_number" class="block mt-1 w-full" type="text"
                name="engine_number" />
            <x-input-error :messages="$errors->get('engine_number')" class="mt-2" />
        </div>
        <div class="w-1/2">
            <x-input-label for="chassis_number" :value="__('Chasis Number')" />
            <x-text-input wire:model="chassis_number" id="chassis_number" class="block mt-1 w-full" type="text"
                name="chassis_number" />
            <x-input-error :messages="$errors->get('chassis_number')" class="mt-2" />
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
