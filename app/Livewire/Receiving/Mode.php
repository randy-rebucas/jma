<?php

namespace App\Livewire\Receiving;

use Livewire\Component;
use App\Traits\CartSession;

class Mode extends Component
{
    use CartSession;

    public $mode;
    public $modes = [];

    public function changeMode($mode)
    {
        $this->setModeValue('receiving-mode', $mode);
        $this->dispatch('changeMode', mode: $mode);
    }

    public function onClickLists()
    {
        return $this->redirect('/receivings/view', navigate: true);
    }

    public function mount()
    {
        $this->modes['receive'] = 'Receive';
        $this->modes['return'] = 'Return';
    }
    public function render()
    {
        return view('livewire.receiving.mode');
    }
}
