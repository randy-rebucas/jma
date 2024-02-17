<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Facades\Cart;

new class extends Component {
    public $option;

    public $mode;
    public $total;
    public $showFlashMessage = false;

    protected $listeners = ['activeMode', 'saleCompleted', 'addItem', 'saleCanceled', 'removeItem'];

    #[On('saleCompleted')]
    public function saleCompleted()
    {
        $this->showFlashMessage = true;
    }

    public function mount($option)
    {
        $this->option = $option;
        $this->mode = 'sales';
        $this->total = Cart::total();
    }

    public function addItem()
    {
        $this->total = Cart::total();
    }

    public function saleCanceled()
    {
        $this->addItem();
    }

    public function removeItem()
    {
        $this->addItem();
    }

    public function activeMode($value)
    {
        $this->mode = $value;
    }

    public function viewSales()
    {
        $this->option = 'view';
    }

    public function viewRegister()
    {
        $this->option = 'register';
    }
}; ?>

<section>
    @if ($showFlashMessage)
        <div wire:transition.out.opacity.duration.200ms
            class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex items-center">
                <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 20 20">
                        <path
                            d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z" />
                    </svg></div>
                <div>
                    <p class="font-bold">Sale successfully registered.</p>
                </div>
            </div>
        </div>
    @endif
    <div class="flex flex-row justify-between">
        <div class="w-3/4">
            <div class="bg-slate-200 flex justify-between p-2 dark:bg-gray-800">
                <livewire:sale.register-mode :activeMode="$mode" />
                <div class="flex">
                    <x-secondary-button class="ms-3 mx-3" wire:click="viewSales">
                        {{ __('Daily Sales') }}
                    </x-secondary-button>
                    {{-- <x-secondary-button class="ms-3 mx-3" wire:click="viewRegister">
                        {{ __('Register') }}
                    </x-secondary-button> --}}
                </div>
            </div>
            <div class="bg-slate-100 flex justify-between p-2 dark:bg-gray-700">
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

        <div class="bg-slate-100 dark:bg-gray-700 dark:text-gray-200 m-1 p-2 w-1/4">
            <livewire:sale.summary :activeMode="$mode" />
        </div>
    </div>
</section>
