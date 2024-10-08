<div class="relative">
    <form class="mx-auto" wire:submit="lookup">
        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">{{ __('Search') }}</label>
        <div class="relative">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
            </div>
            <x-text-input wire:model.debounce.500ms="searchTerm"
                class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                type="search" :placeholder="__('Search cars...')" autofocus />
            <button type="submit"
                class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
        </div>
    </form>

    @if (isset($results))
        <ul class="absolute w-full bg-white border-gray-100 mt-2">
            @foreach ($results as $result)
                <li wire:click="onClickItem({{ $result->id }})"
                    class="pl-4 pr-2 py-2 border-b-2 border-gray-100 relative cursor-pointer hover:bg-yellow-50 hover:text-gray-900 flex">
                    <div class="px-2">
                        <p>{{ $result->car->brand }}: {{ $result->car->plate_number }}</p>
                        <p>{{ $result->customer->full_name }} </p>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
