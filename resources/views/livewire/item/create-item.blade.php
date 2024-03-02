<x-modal form-action="submit">
    <x-slot name="title">
        {{ __('Create new Item') }}
    </x-slot>
    <fieldset class="border-2 border-double border-gray-200 p-4 rounded-md">
        <legend class="dark:text-gray-200 px-2">{{ __('Item Details') }}</legend>

        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <x-textarea wire:model="description" class="w-full" />
        </div>

        <div class="flex justify-between gap-4 mt-4">
            <div class="w-1/3">
                <x-input-label for="price" :value="__('Price')" />
                <x-text-input wire:model="price" id="price" class="block mt-1 w-full" type="text"
                    name="price" />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>
            <div class="w-1/3">
                <x-input-label for="reorder_level" :value="__('Re-Order Level')" />
                <x-text-input wire:model="reorder_level" id="reorder_level" class="block mt-1 w-full" type="number"
                    name="reorder_level" />
                <x-input-error :messages="$errors->get('reorder_level')" class="mt-2" />
            </div>
            <div class="w-1/3">
                <x-input-label for="receiving_quantity" :value="__('Receiving Quantity')" />
                <x-text-input wire:model="receiving_quantity" id="receiving_quantity" class="block mt-1 w-full"
                    type="number" name="receiving_quantity" />
                <x-input-error :messages="$errors->get('receiving_quantity')" class="mt-2" />
            </div>
        </div>

        <div class="flex justify-between gap-4 mt-4">
            <div class="w-1/2">
                <x-input-label for="type" :value="__('Category')" />
                <x-select wire:model="category_id" id="category_id" name="category_id" :options="$categories"
                    class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            </div>
            <div class="w-1/2">
                <x-input-label for="type" :value="__('Supplier')" />
                <x-select wire:model="supplier_id" id="supplier_id" name="supplier_id" :options="$suppliers"
                    class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('supplier_id')" class="mt-2" />
            </div>
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
