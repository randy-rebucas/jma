<?php

use Livewire\Volt\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use App\Facades\Cart;

new class extends Component {
    use LivewireAlert;
    public $mode;
    public $option;
    public $total;

    #[On('change-mode')]
    public function changeRegisterMode($mode)
    {
        $this->mode = $mode;
    }

    #[On('saleCompleted')]
    public function saleCompleted($serial)
    {
        $this->alert('success', "{$serial} successfully registered?", [
            'position' => 'center',
            'toast' => false,
            'timer' => 3000,
        ]);

        Cart::clear();
    }

    #[On('errorAddItem')]
    public function errorAddItem($name, $quantity)
    {
        $this->alert('error', "Item {$name} is only {$quantity} stocks? ", [
            'position' => 'center',
            'toast' => false,
            'timer' => 3000,
        ]);
    }

    #[On('addItem')]
    #[On('saleCanceled')]
    #[On('removeItem')]
    public function getCartTotal()
    {
        $this->total = Cart::total();
    }

    public function mount($option)
    {
        $this->option = $option;
        $this->getCartTotal();
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
    <div class="flex flex-row justify-between">
        <div class="w-3/4">
            <div class="bg-slate-200 flex justify-between p-2 dark:bg-gray-800">
                <livewire:sale.register-mode />
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
