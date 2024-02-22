<div>
    <div class="dark:bg-gray-900 dark:text-gray-100 bg-slate-100 flex items-center justify-between mb-2 p-2">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Owned Cars</h2>
        <x-secondary-button class="ms-3 py-3"
            wire:click="$dispatch('openModal', { component: 'customer.car.create-car', arguments: {customer: {{ $customer->id }}} })">
            {{ __('Create Car') }}
        </x-secondary-button>
    </div>
    <div class="flex gap-4">
        @forelse ($cars as $item)
            <div class="dark:bg-gray-700 max-w-sm rounded shadow-lg relative">
                <div class="px-6 dark:text-gray-200">
                    <div class="font-bold text-xl mb-2">
                        {{ $item->car->model }}
                        <button type="button"
                            class="dark:bg-gray-500 p-1 rounded-full z-10 absolute -right-4 -top-4 btn btn-info m-1 text-red-600 font-medium underline"
                            wire:click="delete({{ $item->id }})"
                            wire:confirm="Are you sure you want to delete this car?">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                <path
                                    d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                            </svg>
                        </button>
                    </div>
                    <p class="text-lg">
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
        @empty
            <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3 rounded m-3 flex-1"
                role="alert">
                <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path
                        d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
                </svg>
                <p>{{ __('No car/unit added.') }}</p>
            </div>
        @endforelse
    </div>
</div>
