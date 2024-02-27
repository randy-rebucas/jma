<?php

namespace App\Livewire\Pos;

use Livewire\Component;
use Livewire\Attributes\On;

class RegisterMode extends Component
{
    public $mode;
    public $uri;
    public $uriLabel;
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
        if (request()->routeIs('jobs')) {
            $this->modes['order'] = 'Order';
            $this->modes['estimate'] = 'Estimate';
            $this->uri = 'jobs';
            $this->uriLabel = 'View Jobs';
        }
        if (request()->routeIs('sales')) {
            $this->modes['sales'] = 'Sale';
            $this->modes['return'] = 'Return';
            $this->uri = 'sales';
            $this->uriLabel = 'View Sales';
        }
        if (request()->routeIs('receivings')) {
            $this->modes['receive'] = 'Receive';
            $this->modes['return'] = 'Return';
            $this->uri = 'receivings';
            $this->uriLabel = 'View Receivings';
        }
        
        $this->mode = session('mode');
    }
    public function previewView()
    {
        return $this->redirect('/' . $this->uri . '/view', navigate: true);
    }
    public function render()
    {
        return view('livewire.pos.register-mode');
    }
}
