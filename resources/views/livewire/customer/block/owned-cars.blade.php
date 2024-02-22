<div>
    <div class="bg-slate-100 flex items-center justify-between mb-2 p-2">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Owned Cars</h2>
        <x-secondary-button class="ms-3 py-3"
            wire:click="$dispatch('openModal', { component: 'customer.car.create-car', arguments: {customer: {{ $customer->id }}} })">
            {{ __('Create Car') }}
        </x-secondary-button>
    </div>
    <div class="flex gap-4">
        @foreach ($cars as $item)
            <div class="max-w-sm rounded overflow-hidden shadow-lg relative">
                <div class="px-6">
                    <div class="font-bold text-xl mb-2">
                        {{ $item->car->model }}
                        <button type="button" class="absolute right-1 btn btn-info m-1 text-red-600 font-medium underline"
                            wire:click="delete({{ $item->id }})"
                            wire:confirm="Are you sure you want to delete this car?">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-gray-700 text-lg">
                        {{ $item->car->plate_number }}
                    </p>
                    <p>Engine #: {{ $item->car->engine_number }}</p>
                    <p>Chassis #: {{ $item->car->chassis_number }}</p>
                    <p>Year: {{ $item->car->year }}</p>
                </div>
                <div class="px-3 pb-2">
                    <span
                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $item->car->brand }}</span>
                    <span
                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $item->car->color }}</span>
                    <span
                        class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2">{{ $item->car->odo_km }}</span>
                </div>
            </div>
        @endforeach
    </div>
</div>
