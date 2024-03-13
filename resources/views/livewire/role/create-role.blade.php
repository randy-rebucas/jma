<x-modal form-action="submit">
    <x-slot name="title">
        {{ __('Create Role') }}
    </x-slot>

    <div class="mt-4">
        <x-input-label for="name" :value="__('Role Name')" />
        <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="role" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <div class="mt-4">
        <ul>
            @foreach ($permissions as $permission)
                <li>
                    <label class="checkbox-wrap">
                        <input type="checkbox" wire:model="assigned_permissions" value="{{ $permission }}"
                            wire:model.defer="permission">
                        {{ $permission }}
                    </label>
                </li>
            @endforeach
        </ul>
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
