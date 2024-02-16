<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;

new class extends Component {
    public $mode;
    public $showFlashMessage = false;

    protected $listeners = ['activeMode', 'saleCompleted'];

    #[On('saleCompleted')]
    public function saleCompleted()
    {
        $this->showFlashMessage = true;
    }

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

    public function doCanceled()
    {
    }
}; ?>

<section>
    @if ($showFlashMessage)
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="flex flex-row justify-between">
        <div class="w-3/4">
            <div class="bg-slate-200 flex justify-between p-2">
                <livewire:sale.register-mode :activeMode="$mode" />
                <div class="flex">
                    <x-secondary-button class="ms-3 mx-3" wire:click="doSuspendSale">
                        {{ __('Suspended') }}
                    </x-secondary-button>
                    <x-secondary-button class="ms-3 mx-3" wire:click="doCanceled"
                        wire:confirm="Are you sure you want to clear this sale? All items will be cleared.">
                        {{ __('Cancel') }}
                    </x-secondary-button>
                </div>
            </div>
            <div class="bg-slate-100 flex justify-between p-2">
                <livewire:sale.scan-item />
                <x-secondary-button class="ms-3 mx-3"
                    wire:click="$dispatch('openModal', { component: 'item.create-item' })">
                    {{ __('New Item') }}
                </x-secondary-button>
            </div>
            <div class="h-96">
                <livewire:sale.line-items />
            </div>
        </div>

        <div class="bg-slate-100 m-1 p-2 w-1/4">
            <livewire:sale.summary :activeMode="$mode" />
        </div>
    </div>
</section>
