<div>
    <x-table for="employee">
        <x-table.thead>
            <x-table.row class="dark:bg-gray-900 dark:text-gray-100">
                <x-table.thead-cell :title="__('Assigned Roles')" class="text-left" />
                <x-table.thead-cell title="" :action="true" class="text-right">
                    <button type="button" class="btn btn-info m-1 font-medium underline"
                        wire:click="$dispatch('openModal', { component: 'employee.block.assign-role', arguments: {employeeId: {{ $employee->id }} } })">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                    </button>
                </x-table.thead-cell>
            </x-table.row>
        </x-table.thead>
        <x-table.tbody class="dark:border-gray-500">
            @forelse ($employee->user->getRoleNames() as $role)
                <x-table.row class="bg-white dark:bg-gray-700 dark:text-white" wire:loading.class="opacity-50">
                    <x-table.tbody-cell :item="$role" />
                    <x-table.tbody-cell :item="$role" class="text-right" :action="true">
                        <button type="button" class="btn btn-info m-1 text-red-600 font-medium underline"
                            wire:click="delete('{{ $role }}')"
                            wire:confirm="Are you sure you want to remove this role?" title="Remove role">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                            </svg>

                        </button>
                    </x-table.tbody-cell>
                </x-table.row>
            @empty
                <x-table.row class="bg-white dark:bg-gray-700 dark:text-white">
                    <x-table.tbody-cell colspan="6" :item="__('No role found!!')" />
                </x-table.row>
            @endforelse
        </x-table.tbody>
    </x-table>

</div>
