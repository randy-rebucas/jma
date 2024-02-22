<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $customer->full_name }} {{ __('Detail') }}
    </h2>
</x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="min-w-full">
                
                <section>
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ $customer->full_name }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Total Purchased: {{ count($customer->sales) }}
                        </p>
                    </header>
                    <div class="flex gap-4 justify-center mt-6">
                        <div class="flex-1">
                            <livewire:customer.block.addresses :customer="$customer"/>
                        </div>
                        <div class="w-1/2">
                            <livewire:customer.block.owned-cars :customer="$customer"/>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="w-full">
                <livewire:customer.block.purchased-histories :sales="$customer->sales"/>
            </div>
        </div>
    </div>
</div>
