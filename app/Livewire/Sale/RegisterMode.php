<?php

namespace App\Livewire\Sale;

use Livewire\Component;

class RegisterMode extends Component
{
    public $mode;
    public $modes = [];
    
    public function changeRegisterMode($mode) {
        $this->dispatch('activeMode', $mode);
    }

    public function mount($activeMode = 'sales')
    {
        $this->mode = $activeMode;
        
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
