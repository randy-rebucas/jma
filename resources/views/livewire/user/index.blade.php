<x-slot name="header">
    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
        {{ __('Manage Users') }}
    </h2>

    <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Create, Edit, Delete and Search user.') }}
    </p>
</x-slot>

<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="space-y-6">
                    <div class="flex justify-between">
                        <x-text-input wire:model.live="search" class="py-2" type="search" :placeholder="__('Search Users...')" />
                        {{-- <x-secondary-button class="ms-3 py-3"
                            wire:click="$dispatch('openModal', { component: 'user.create-user'})">
                            {{ __('Create User') }}
                        </x-secondary-button> --}}
                    </div>

                    <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                        <x-table for="user">
                            <x-table.thead>
                                <x-table.row class="dark:bg-gray-900 dark:text-gray-100">
                                    <x-table.thead-cell :title="__('Name')" class="text-left" />
                                    <x-table.thead-cell :title="__('Email')" class="text-left" />
                                    <x-table.thead-cell :title="__('Created')" class="text-left" />
                                    <x-table.thead-cell :title="__('Roles')" class="text-left" />
                                    {{-- <x-table.thead-cell title="" class="text-right" /> --}}
                                </x-table.row>
                            </x-table.thead>
                            <x-table.tbody class="dark:border-gray-500">
                                @forelse ($users as $user)
                                    <x-table.row class="bg-white dark:bg-gray-700 dark:text-white"
                                        wire:loading.class="opacity-50">
                                        <x-table.tbody-cell :item="$user->name" class="text-left" />
                                        <x-table.tbody-cell :item="$user->email" class="text-left" />
                                        <x-table.tbody-cell :item="$user->created_at" class="text-left" />
                                        <x-table.tbody-cell :item="$user->id" :action="true" class="text-left">
                                            @foreach ($user->getRoleNames() as $index => $role)
                                                {{ $role }}
                                            @endforeach
                                        </x-table.tbody-cell>
                                        {{-- <x-table.tbody-cell :item="$user->id" class="text-right" :action="true">
                                            <button type="button" class="btn btn-info m-1 font-medium underline"
                                                wire:click="onView({{ $user->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" class="w-5 h-5">
                                                    <path d="M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                                    <path fill-rule="evenodd"
                                                        d="M.664 10.59a1.651 1.651 0 0 1 0-1.186A10.004 10.004 0 0 1 10 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0 1 10 17c-4.257 0-7.893-2.66-9.336-6.41ZM14 10a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            <button type="button" class="btn btn-info m-1 font-medium underline"
                                                wire:click="$dispatch('openModal', {component: 'user.edit-user', arguments: {userId: {{ $user->id }} }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" class="w-5 h-5">
                                                    <path
                                                        d="m2.695 14.762-1.262 3.155a.5.5 0 0 0 .65.65l3.155-1.262a4 4 0 0 0 1.343-.886L17.5 5.501a2.121 2.121 0 0 0-3-3L3.58 13.419a4 4 0 0 0-.885 1.343Z" />
                                                </svg>
                                            </button>
                                            <button type="button"
                                                class="btn btn-info m-1 text-red-600 font-medium underline"
                                                wire:click="delete({{ $user->id }})"
                                                wire:confirm="Are you sure you want to delete this user?">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" class="w-5 h-5">
                                                    <path fill-rule="evenodd"
                                                        d="M8.75 1A2.75 2.75 0 0 0 6 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 1 0 .23 1.482l.149-.022.841 10.518A2.75 2.75 0 0 0 7.596 19h4.807a2.75 2.75 0 0 0 2.742-2.53l.841-10.52.149.023a.75.75 0 0 0 .23-1.482A41.03 41.03 0 0 0 14 4.193V3.75A2.75 2.75 0 0 0 11.25 1h-2.5ZM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4ZM8.58 7.72a.75.75 0 0 0-1.5.06l.3 7.5a.75.75 0 1 0 1.5-.06l-.3-7.5Zm4.34.06a.75.75 0 1 0-1.5-.06l-.3 7.5a.75.75 0 1 0 1.5.06l.3-7.5Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </x-table.tbody-cell> --}}
                                    </x-table.row>
                                @empty
                                    <x-table.row class="bg-white dark:bg-gray-700 dark:text-white">
                                        <x-table.tbody-cell colspan="6" :item="__('No user found!!')" />
                                    </x-table.row>
                                @endforelse
                            </x-table.tbody>
                        </x-table>
                    </div>
                    <div>
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
