<div>
    <div class="flex gap-6 justify-items-center">
        <div class="flex gap-4 items-center">
            <x-input-label for="name" :value="__('Start')" />
            <x-text-input wire:model="fromDate"
                class="p-2 py-2 border focus:outline-none focus:shadow-outline rounded shadow" type="input"
                name="fromDate" id="fromDate" readonly :placeholder="__('From Date')" />
        </div>
        <div class="flex gap-4 items-center">
            <x-input-label for="name" :value="__('End')" />
            <x-text-input wire:model="toDate"
                class="p-2 py-2 border focus:outline-none focus:shadow-outline rounded shadow" type="input"
                name="toDate" id="toDate" readonly :placeholder="__('To Date')" />
        </div>

        <x-secondary-button class="" wire:click="filter" :disabled="!$fromDate || !$toDate" >
            {{ __('Filter') }}
        </x-secondary-button>

        <x-secondary-button class="" wire:click="print" :disabled="$isPrintDisabled">
            {{ __('Print') }}
        </x-secondary-button>
    </div>

    @push('scripts')
        <script>
            var startDate,
                endDate,
                updateStartDate = function() {
                    startPicker.setStartRange(startDate);
                    endPicker.setStartRange(startDate);
                    endPicker.setMinDate(startDate);
                },
                updateEndDate = function() {
                    startPicker.setEndRange(endDate);
                    startPicker.setMaxDate(endDate);
                    endPicker.setEndRange(endDate);
                },
                startPicker = new Pikaday({
                    field: document.getElementById('fromDate'),
                    minDate: new Date(),
                    maxDate: new Date(2020, 12, 31),
                    theme: "pikaday-white",
                    onSelect: function() {
                        startDate = this.getDate();
                        updateStartDate();
                        @this.set('fromDate', startPicker.toString());
                    }
                }),
                endPicker = new Pikaday({
                    field: document.getElementById('toDate'),
                    minDate: new Date(),
                    maxDate: new Date(2020, 12, 31),
                    theme: "pikaday-white",
                    onSelect: function() {
                        endDate = this.getDate();
                        updateEndDate();
                        @this.set('toDate', endPicker.toString());
                    }
                }),
                _startDate = startPicker.getDate(),
                _endDate = endPicker.getDate();

            if (_startDate) {
                startDate = _startDate;
                updateStartDate();
            }

            if (_endDate) {
                endDate = _endDate;
                updateEndDate();
            }
        </script>
    @endpush
</div>
