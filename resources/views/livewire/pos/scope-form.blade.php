<form wire:submit="add" class="flex-1">
    <div class="flex items-center gap-6">
        <x-text-input wire:model="scope_name" id="scope_name" class="block  bg-gray-100 grow"
            type="text" name="scope_name" :placeholder="__('Name')" />

        <x-text-input wire:model="scope_amount" id="scope_amount" class="block  bg-gray-100"
            type="number" name="scope_amount" :placeholder="__('Cost')" />

        <x-primary-button class="ms-3 mx-3 py-3" wire:loading.attr="disabled">
            {{ __('Add') }}
        </x-primary-button>
    </div>
</form>