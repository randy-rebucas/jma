<?php

namespace App\Livewire\Sale;

use Livewire\Component;
use Livewire\Attributes\On;
class RegisterMode extends Component
{
    public $mode;
    public $modes = [];

    public function changeRegisterMode($mode)
    {
        if ($mode != '') {
            session()->put('mode', $mode);
            $this->dispatch('change-mode', mode: $mode);
        } else {
            $this->dispatch('reload');
        }
    }

    #[On('reload')]
    public function mount()
    {
        $this->mode = session('mode') ? session('mode') : session()->put('mode', config('settings.register_mode'));

        $this->modes = [
            'sales' => 'Sales',
            'return' => 'Return',
            'order' => 'Order',
            'estimate' => 'Estimate',
        ];
    }

    public function render()
    {
        return view('livewire.sale.register-mode');
    }
}
