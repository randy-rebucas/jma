<div class="border-t-2 border-indigo-500 mt-2 pb-1 shadow">
    @if ($content->count() > 0)
        <x-table for="items">
            <x-table.thead>
                <x-table.row class="dark:bg-gray-900 dark:text-gray-100">
                    <x-table.thead-cell :title="__('Item Name')" class="text-left w-24" />
                    <x-table.thead-cell :title="__('Quantity')" class="text-center w-24" />
                    <x-table.thead-cell :title="__('Price')" class="text-right w-24" />
                    <x-table.thead-cell :title="__('Sub Total')" class="text-right w-24" />
                    <x-table.thead-cell title="" class="text-right w-24" />
                </x-table.row>
            </x-table.thead>
            <x-table.tbody class="dark:border-gray-500">
                @foreach ($content as $item)
                    <x-table.row class="bg-white dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
                        <x-table.tbody-cell :item="$item->name" class="md:py-1 w-24" />
                        <x-table.tbody-cell :item="$item->qty" class="text-center md:py-1 w-24" :action="true">
                            <div class="flex items-center ">
                                <button type="button" class="btn btn-info m-1 text-red-600 font-medium underline"
                                    wire:click="decrement('{{ $item->rowId }}')">
                                    <svg viewBox="0 0 22 22" class="w-5 h-5" version="1.1"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="Page-1" fill="currentColor" fill-rule="evenodd">
                                            <g id="Dribbble-Light-Preview"
                                                transform="translate(-219.000000, -600.000000)" fill="#8b2626">
                                                <g id="icons" transform="translate(56.000000, 160.000000)">
                                                    <path
                                                        d="M177.7,450 C177.7,450.552 177.2296,451 176.65,451 L170.35,451 C169.7704,451 169.3,450.552 169.3,450 C169.3,449.448 169.7704,449 170.35,449 L176.65,449 C177.2296,449 177.7,449.448 177.7,450 M173.5,458 C168.86845,458 165.1,454.411 165.1,450 C165.1,445.589 168.86845,442 173.5,442 C178.13155,442 181.9,445.589 181.9,450 C181.9,454.411 178.13155,458 173.5,458 M173.5,440 C167.70085,440 163,444.477 163,450 C163,455.523 167.70085,460 173.5,460 C179.29915,460 184,455.523 184,450 C184,444.477 179.29915,440 173.5,440"
                                                        id="minus_circle-[#1426]">
                                                    </path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                </button>

                                <span class="grow ">{{ $item->qty }}</span>

                                <button type="button" class="btn btn-info m-1 text-red-600 font-medium underline"
                                    wire:click="increment('{{ $item->rowId }}')">
                                    <svg viewBox="0 0 22 22" class="w-5 h-5" fill="#3b82f6"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <g id="Edit / Add_Plus_Circle">
                                            <path id="Vector"
                                                d="M8 12H12M12 12H16M12 12V16M12 12V8M12 21C7.02944 21 3 16.9706 3 12C3 7.02944 7.02944 3 12 3C16.9706 3 21 7.02944 21 12C21 16.9706 16.9706 21 12 21Z"
                                                stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round" />
                                        </g>
                                    </svg>
                                </button>
                            </div>
                        </x-table.tbody-cell>
                        <x-table.tbody-cell :item="$item->price" class="text-right md:py-1 w-24" :action="true">
                            @currency($item->price)
                        </x-table.tbody-cell>
                        <x-table.tbody-cell :item="$item->total" class="text-right md:py-1 w-24" :action="true">
                            @currency($item->total)
                        </x-table.tbody-cell>
                        <x-table.tbody-cell :item="$item->id" class="text-right md:py-1 w-24" :action="true">
                            <button type="button" class="btn btn-info m-1 text-red-600 font-medium underline"
                                wire:click="remove('{{ $item->rowId }}')">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="w-5 h-5">
                                    <path
                                        d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                                </svg>
                            </button>
                        </x-table.tbody-cell>
                    </x-table.row>
                @endforeach
            </x-table.tbody>
        </x-table>
    @else
        <div class="flex items-center bg-blue-500 text-white text-sm font-bold px-4 py-3 rounded m-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
            </svg>
            <p>{{ __('Start typing on the box or scan the item.') }}</p>
        </div>
    @endif
</div>
