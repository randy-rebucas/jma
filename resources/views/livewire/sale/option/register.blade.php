<section>
    <div class="flex flex-row justify-between">
        <div class="w-3/4">
            <div class="bg-slate-200 flex justify-between p-2 dark:bg-gray-800">
                <livewire:sale.register-mode />
                <div class="flex">
                    <x-secondary-button class="ms-3 mx-3" wire:click="previewView">
                        {{ __('Daily Sales') }}
                    </x-secondary-button>
                </div>
            </div>
            <div class="bg-slate-100 flex justify-between p-2 dark:bg-gray-700">
                <livewire:sale.scan-item />
                <x-secondary-button class="ms-3 mx-3"
                    wire:click="$dispatch('openModal', { component: 'item.create-item' })">
                    {{ __('New Item') }}
                </x-secondary-button>
            </div>
            <div class="h-auto">
                <livewire:sale.line-items />
                @if ($mode == 'order')
                    <livewire:sale.job.order />
                @endif
                @if ($mode == 'estimate')
                    <livewire:sale.job.estimate />
                @endif
            </div>
        </div>

        <div class="bg-slate-100 dark:bg-gray-700 dark:text-gray-200 m-1 p-2 w-1/4">
            <livewire:sale.summary />
        </div>
    </div>
</section>
