<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $supplier->full_name }} <smal class="font-extralight text-green-600 text-sm">(Total Items: {{ count($supplier->items) }})</smal>
    </h2>
</x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="min-w-full">
                <livewire:supplier.block.items :items="$supplier->items" />
            </div>
        </div>
    </div>
</div>
