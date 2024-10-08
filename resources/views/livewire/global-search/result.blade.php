<x-slot name="header">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ $car->brand . '-' . $car->plate_number }}
    </h2>

    <p class="mt-1 dark:text-gray-400 font-extralight text-green-600 text-sm">
        ({{ __('Owner:' . $customer->full_name) }} )
    </p>
</x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="min-w-full">
                <livewire:customer.car.detail-car :car="$car" />
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="w-full">
                <livewire:job.detail-job :car="$car" />
            </div>
        </div>

        {{-- <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="w-full">
                <livewire:customer.block.purchased-histories :sales="$customer->sales" />
            </div>
        </div> --}}
    </div>
</div>
