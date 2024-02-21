<x-modal form-action="deleteUser">
    <x-slot name="title">
        {{ __('Confirmation.') }}
    </x-slot>

    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Are you sure you want to delete your account?') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
    </p>

    <div class="mt-6">
        <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

        <x-text-input wire:model="password" id="password" name="password" type="password"
            class="mt-1 block w-3/4" placeholder="{{ __('Password') }}" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>
    <x-slot name="buttons">
        <div class="flex items-center justify-end">
            <x-secondary-button class="ms-3" wire:click="$dispatch('closeModal')">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-danger-button class="ms-3">
                {{ __('Delete Account') }}
            </x-danger-button>
        </div>
    </x-slot>
</x-modal>
