<x-modal>
    <x-slot name="title">
        {{ __('Categories') }}
    </x-slot>
    <form wire:submit="save" class="flex">
        <x-text-input wire:model="name" id="name" class="block w-full bg-gray-100" type="text" name="name"
            autofocus />

        <x-primary-button class="ms-3" wire:loading.attr="disabled">
            {{ __('Submit') }}
        </x-primary-button>
    </form>
    <x-input-error :messages="$errors->get('name')" />
    <x-table for="categories">
        <x-table.thead>
            <x-table.row class="dark:bg-gray-900 dark:text-gray-100">
                <x-table.thead-cell :title="__('Name')" />
                <x-table.thead-cell :title="__('Slug')" class="text-center" />
                <x-table.thead-cell title="" class="text-right" />
            </x-table.row>
        </x-table.thead>
        <x-table.tbody class="dark:border-gray-500">
            @forelse ($categories as $category)
                <x-table.row class="bg-white dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
                    <x-table.tbody-cell :item="$category->name" class="md:py-1" />
                    <x-table.tbody-cell :item="$category->slug" class="md:py-1" />
                    <x-table.tbody-cell :item="$category->id" :action="true" class="text-right md:py-1">
                        <button type="button" class="btn btn-info m-1 text-red-600 font-medium underline"
                            wire:click="delete({{ $category->id }})"
                            wire:confirm="Are you sure you want to delete this category?">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="w-5 h-5">
                                <path
                                    d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                            </svg>
                        </button>
                    </x-table.tbody-cell>
                </x-table.row>
            @empty
                <x-table.row class="bg-white dark:bg-gray-700 dark:text-white">
                    <x-table.tbody-cell colspan="2" :item="'No category found!!'" />
                </x-table.row>
            @endforelse
        </x-table.tbody>
    </x-table>
    <x-slot name="buttons">
        <div class="flex items-center justify-end">
            <x-secondary-button class="ms-3" wire:click="$dispatch('closeModal')">
                {{ __('Close') }}
            </x-secondary-button>
        </div>
    </x-slot>
</x-modal>
