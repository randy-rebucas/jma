<?php

namespace App\Livewire\Sale;

use Livewire\Component;

class Mode extends Component
{
    public $mode;
    public $modes = [];

    public function changeMode($mode)
    {
        $this->setMode($mode);
        $this->dispatch('changeMode', mode: $mode);
    }

    public function setMode($mode) {
        session()->put('sale-mode', $mode);
    }

    public function getMode() {
        if (!session('sale-mode')) {
            $this->setMode(config('settings.sale_register_mode'));
        }

        return session('sale-mode');
    }

    public function onClickLists()
    {
        return $this->redirect('/sales/view', navigate: true);
    }

    public function mount()
    {
        $this->modes['sale'] = 'Sale';
        $this->modes['return'] = 'Return';

        $this->mode = $this->getMode();
    }
    
    public function render()
    {
        return view('livewire.sale.mode');
    }
}
