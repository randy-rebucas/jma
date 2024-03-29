<div class="flex">
    <div class="flex-1">
        <div class="flex items-center">
            <x-input-label for="item" :value="__('Scan Item')" class="block flex-initial" />
            <div class="relative mx-6 w-3/4 flex">
                <x-text-input wire:model.debounce.500ms="search" wire:keyup="searchResult"
                    wire:keydown.enter="searchResult" class="mx-6 w-3/4" type="text" :placeholder="__('Start typing Item name or scan...')" autofocus />

                <!-- Search result list -->
                @if (!empty($records))
                    <ul class="list-none absolute w-3/4 overflow-visible left-6 top-12 bottom-0">
                        @foreach ($records as $record)
                            <li wire:click="setItem({{ $record->id }})"
                                class="bg-indigo-50 p-2 hover:cursor-pointer hover:bg-slate-100">
                                {{ $record->name . ' - Qty: ' . $record->receiving_quantity }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
    <x-secondary-button class="ms-3 mx-3" wire:click="$dispatch('openModal', { component: 'item.create-item' })">
        {{ __('New Item') }}
    </x-secondary-button>
</div>
