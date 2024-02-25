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
        } else {
            $this->modes['sales'] = 'Sale';
            $this->modes['return'] = 'Return';
        }
        
        $this->mode = session('mode');
        $this->uri = request()->routeIs('jobs') ? 'jobs' : 'sales';
        $this->uriLabel = request()->routeIs('jobs') ? 'View Jobs' : 'View Sales';
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
