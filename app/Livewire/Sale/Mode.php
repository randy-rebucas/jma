<?php

namespace App\Livewire\Sale;

use Livewire\Component;
use App\Traits\CartSession;

class Mode extends Component
{
    use CartSession;

    public $mode;
    public $modes = [];

    public function changeMode($mode)
    {
        $this->setModeValue('sale-mode', $mode);
        $this->dispatch('changeMode', mode: $mode);
    }

    public function onClickLists()
    {
        return $this->redirect('/sales/view', navigate: true);
    }

    public function mount()
    {
        $this->modes['sale'] = 'Sale';
        $this->modes['return'] = 'Return';
    }
    
    public function render()
    {
        return view('livewire.sale.mode');
    }
}
