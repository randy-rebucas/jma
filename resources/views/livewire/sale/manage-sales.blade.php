<?php

use Livewire\Volt\Component;

new class extends Component {
    public $mode;

    protected $listeners = ['activeMode'];

    public function mount()
    {
        $this->mode = 'sales';
    }

    public function activeMode($value)
    {
        $this->mode = $value;
    }

    public function doSuspended()
    {
        dd('suspend');
    }

    public function doCreateItem() {

    }
}; ?>

<section>
    <div class="flex flex-row justify-between">
        <div class="w-3/4">
            <div class="bg-slate-200 flex justify-between p-2">
                <livewire:sale.register-mode :activeMode="$mode" />
                <x-secondary-button class="ms-3 mx-3" wire:click="doSuspendSale">
                    {{ __('Suspended') }}
                </x-secondary-button>
            </div>
            <div class="bg-slate-100 flex justify-between p-2">
                <livewire:sale.scan-item />
                <x-secondary-button class="ms-3 mx-3" wire:click="doCreateItem">
                    {{ __('New Item') }}
                </x-secondary-button>
            </div>
            <div class="h-96">
                <livewire:sale.line-items />
            </div>
        </div>

        <div class="bg-slate-100 m-1 p-2 w-1/4">
            <livewire:sale.summary />
        </div>
    </div>
</section>
