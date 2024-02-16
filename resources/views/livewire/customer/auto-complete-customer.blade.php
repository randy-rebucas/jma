<div>
    <!-- CSS -->
    <style type="text/css">
        .search-box .clear {
            clear: both;
            margin-top: 20px;
        }
    </style>
    <div class="search-box">
        @if (!$details)
            <x-text-input wire:model="search" wire:keyup="searchResult" class="block mt-1 w-full" type="text"
                placeholder="find customer" />
        @endif
        <!-- Search result list -->
        @if ($showresult)
            <ul class="list-none absolute w-3/4 overflow-visible">
                @if (!empty($records))
                    @foreach ($records as $record)
                        <li wire:click="fetchDetail({{ $record->id }})"
                            class="bg-indigo-50 p-2 hover:cursor-pointer hover:bg-violet-400">
                            {{ $record->first_name . ' ' . $record->last_name }}</li>
                    @endforeach
                @endif
            </ul>
        @endif

        <div class="clear-both"></div>
        <div>
            @if (!empty($details))
                <div class="dark:text-green-400">
                    Name : {{ $details->first_name . ' ' . $details->last_name }} <br>
                    Email : {{ $details->user->email }}
                </div>
            @endif
        </div>
    </div>
</div>
