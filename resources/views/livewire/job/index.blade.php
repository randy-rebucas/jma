<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ __('Jobs') }}
    </h2>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white dark:bg-gray-800">
            <div class="min-w-full">
                @if ($option == 'view')
                    <livewire:job.option.preview />
                @else
                    <livewire:job.option.register />
                @endif
            </div>
        </div>
    </div>
</div>
