<x-slot name="header">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Register Sales') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Select Mode, Customer and Add Items') }}
    </p>
</x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="min-w-full">
                @if ($option == 'view')
                    <livewire:sale.option.preview />
                @else
                    <livewire:sale.option.register :mode="$mode" />
                @endif
            </div>
        </div>
    </div>
</div>
