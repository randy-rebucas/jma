<div>
    <form wire:submit="uploadLogo" class="flex gap-6 mb-4">
        <div>
            @if (config('settings.business_logo'))
                <img src="{{ asset('storage/' . config('settings.business_logo')) }}" class="mx-3">
            @else
                <img src="https://placehold.co/150x60?text=Logo" alt="placeholder" class="ml-4 rounded-lg">
            @endif
        </div>
        {{-- <div wire:loading wire:target="photo">Uploading...</div> --}}
        <div x-data="{ uploading: false, progress: 0 }" x-on:livewire-upload-start="uploading = true"
            x-on:livewire-upload-finish="uploading = false" x-on:livewire-upload-cancel="uploading = false"
            x-on:livewire-upload-error="uploading = false"
            x-on:livewire-upload-progress="progress = $event.detail.progress" class="whitespace-nowrap">
            <div x-show="uploading">
                <progress max="100" x-bind:value="progress"></progress>
            </div>
            @error('photo')
                <span class="error">{{ $message }}</span>
            @enderror

            <div class="mb-2 md:flex p-4 shadow">
                <div class="flex items-start flex-col md:w-1/2">
                    <x-input-label for="business_name" :value="__('Logo')"
                        class="block text-gray-500 md:text-right mb-1 md:mb-0 pr-4" />
                    <span
                        class="text-gray-400 text-sm">{{ __('customize your logo. This will be use on invioce or in any print output.') }}</span>
                </div>
                <div class="md:w-1/2">
                    <input type="file" wire:model="photo"
                        class=" border-gray-300 dark:bg-gray-900 dark:border-gray-700 dark:focus:bg-gray-900 dark:focus:border-indigo-600 dark:focus:ring-indigo-600 dark:text-gray-300 focus:bg-white focus:border-purple-500 focus:outline-none focus:ring-indigo-500 leading-tight px-4 py-2 rounded-md text-gray-700">
                </div>
            </div>
            <x-primary-button class="mb-2 ml-4" wire:loading.attr="disabled">
                {{ __('Upload') }}
            </x-primary-button>
    </form>
</div>
