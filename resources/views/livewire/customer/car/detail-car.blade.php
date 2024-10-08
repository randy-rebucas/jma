<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Car Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Complete details of the car.') }}
        </p>
    </header>
    <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
        <x-table for="car">
            <x-table.tbody class="dark:border-gray-500">
                <x-table.row class="bg-white dark:bg-gray-700 dark:text-white">
                    <x-table.thead-cell :title="__('Brand:')" class="text-left" />
                    <x-table.tbody-cell :item="$car->brand" class="text-left text-green-600" />
                    <x-table.thead-cell :title="__('Model:')" class="text-left" />
                    <x-table.tbody-cell :item="$car->model" class="text-left text-green-600" />
                </x-table.row>
                <x-table.row class="bg-white dark:bg-gray-700 dark:text-white">
                    <x-table.thead-cell :title="__('Plate #:')" class="text-left" />
                    <x-table.tbody-cell :item="$car->plate_number" class="text-left text-green-600" />
                    <x-table.thead-cell :title="__('Color:')" class="text-left" />
                    <x-table.tbody-cell :item="$car->color" class="text-left text-green-600" />
                </x-table.row>
                <x-table.row class="bg-white dark:bg-gray-700 dark:text-white">
                    <x-table.thead-cell :title="__('Odo KM:')" class="text-left" />
                    <x-table.tbody-cell :item="$car->odo_km" class="text-left text-green-600" />
                    <x-table.thead-cell :title="__('Year build:')" class="text-left" />
                    <x-table.tbody-cell :item="$car->year" class="text-left text-green-600" />
                </x-table.row>
                <x-table.row class="bg-white dark:bg-gray-700 dark:text-white">
                    <x-table.thead-cell :title="__('Engine #:')" class="text-left" />
                    <x-table.tbody-cell :item="$car->engine_number" class="text-left text-green-600" />
                    <x-table.thead-cell :title="__('Chassis #:')" class="text-left" />
                    <x-table.tbody-cell :item="$car->chassis_number" class="text-left text-green-600" />
                </x-table.row>
            </x-table.tbody>
        </x-table>
    </div>
</section>
