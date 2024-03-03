<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Owned Cars/Unit') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('List of all cars/units owned.') }}
        </p>
    </header>
    <div class="mt-6 space-y-6">
        <x-table for="cars">
            <x-table.thead>
                <x-table.row class="dark:bg-gray-900 dark:text-gray-100">
                    <x-table.thead-cell :title="__('Brand')" class="text-left" />
                    <x-table.thead-cell :title="__('Plate #')" class="text-left" />
                    <x-table.thead-cell :title="__('Color')" class="text-left" />
                    <x-table.thead-cell :title="__('Odo')" class="text-left" />
                    <x-table.thead-cell :title="__('Engine #')" class="text-left" />
                    <x-table.thead-cell :title="__('Chassis #')" class="text-left" />
                    <x-table.thead-cell :title="__('Year Build')" class="text-left" />
                    <x-table.thead-cell title="" :action="true" class="text-right">
                        <button type="button" class="btn btn-info m-1 font-medium underline"
                            wire:click="$dispatch('openModal', { component: 'customer.car.create-car', arguments: {customer: {{ $customer->id }}} })">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                        </button>
                    </x-table.thead-cell>
                </x-table.row>
            </x-table.thead>
            <x-table.tbody class="dark:border-gray-500">
                @forelse ($cars as $item)
                    <x-table.row class="bg-white dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
                        <x-table.tbody-cell :item="$item->car->brand" />
                        <x-table.tbody-cell :item="$item->car->plate_number" />
                        <x-table.tbody-cell :item="$item->car->color" />
                        <x-table.tbody-cell :item="$item->car->odo_km" />
                        <x-table.tbody-cell :item="$item->car->engine_number" />
                        <x-table.tbody-cell :item="$item->car->chassis_number" />
                        <x-table.tbody-cell :item="$item->car->year" />
                        <x-table.tbody-cell :item="$item->id" class="text-right md:py-1" :action="true">
                            <button type="button" class="btn btn-info m-1 text-red-600 font-medium underline"
                                wire:click="delete('{{ $item->id }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </x-table.tbody-cell>
                    </x-table.row>
                @empty
                    <x-table.row class="bg-white dark:bg-gray-700 dark:text-white text-center">
                        <x-table.tbody-cell colspan="8" :item="'No address found!!'" />
                    </x-table.row>
                @endforelse
            </x-table.tbody>
        </x-table>
    </div>
</section>
{{-- @forelse ($cars as $item)
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
</div> --}}
