<div class="flex-1">
    <div class="flex items-center">
        <x-input-label for="item" :value="__('Scan Item')" class="block flex-initial" />
        <x-text-input wire:model="search" wire:keyup="searchResult" wire:keydown.enter="searchResult" class="mx-6 w-3/4"
            type="text" placeholder="find item..." />

        <!-- Search result list -->
        @if ($showresult)
            <ul class="list-none absolute w-3/4 overflow-visible">
                @if (!empty($records))
                    @foreach ($records as $record)
                        <li wire:click="setItem({{ $record->id }})"
                            class="bg-indigo-50 p-2 hover:cursor-pointer hover:bg-violet-400">
                            {{ $record->first_name . ' ' . $record->last_name }}</li>
                    @endforeach
                @endif
            </ul>
        @endif
        {{-- <x-text-input wire:keydown.enter="findItem" id="item" class="mx-6 w-3/4" type="text" name="item" /> --}}
    </div>
</div>
