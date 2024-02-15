<x-modal form-action="submit">
    <x-slot name="title">
        Create new Item
    </x-slot>
    <fieldset class="border-2 border-double border-gray-200 p-4 rounded-md">
        <legend class="px-2">Item Details</legend>
        <div class="flex justify-between">
            <div>
                <x-input-label for="code" :value="__('Code')" />
                <x-text-input wire:model="code" id="code" class="block mt-1 w-full" type="text" name="code"
                    readonly />
                <x-input-error :messages="$errors->get('code')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="item_number" :value="__('Item Number')" />
                <x-text-input wire:model="item_number" id="item_number" class="block mt-1 w-full" type="text"
                    name="item_number" autofocus />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="description" :value="__('Description')" />
            <x-textarea wire:model="description" class="w-full" />
        </div>

        <div class="flex justify-between mt-4">
            <div>
                <x-input-label for="cost_price" :value="__('Cost Price')" />
                <x-text-input wire:model="cost_price" id="cost_price" class="block mt-1 w-full" type="text"
                    name="cost_price" />
                <x-input-error :messages="$errors->get('cost_price')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="unit_price" :value="__('Unit Price')" />
                <x-text-input wire:model="unit_price" id="unit_price" class="block mt-1 w-full" type="text"
                    name="unit_price" />
                <x-input-error :messages="$errors->get('unit_price')" class="mt-2" />
            </div>
        </div>

        <div class="flex justify-between mt-4">
            <div>
                <x-input-label for="reorder_level" :value="__('Re-Order Level')" />
                <x-text-input wire:model="reorder_level" id="reorder_level" class="block mt-1 w-full" type="number"
                    name="reorder_level" />
                <x-input-error :messages="$errors->get('reorder_level')" class="mt-2" />
            </div>
            <div>
                <x-input-label for="receiving_quantity" :value="__('Receiving Quantity')" />
                <x-text-input wire:model="receiving_quantity" id="receiving_quantity" class="block mt-1 w-full"
                    type="number" name="receiving_quantity" />
                <x-input-error :messages="$errors->get('receiving_quantity')" class="mt-2" />
            </div>
        </div>

        <div class="mt-4">
            <x-input-label for="type" :value="__('Category')" />
            <x-select wire:model="category_id" id="category_id" name="category_id" :options="$categories"
                class="block mt-1 w-full" />
            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
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
