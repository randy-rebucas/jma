<?php

namespace App\Livewire\Sale;

use Livewire\Component;

class RegisterMode extends Component
{
    public $mode;
    public $modes = [];
    
    public function changeRegisterMode($mode) {
        $this->dispatch('change-mode', mode: $mode);
    }

    public function mount()
    {
        $this->mode = config('settings.register_mode');
        
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
