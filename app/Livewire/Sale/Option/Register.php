<?php

namespace App\Livewire\Sale\Option;

use Livewire\Component;
use Livewire\Attributes\On;
class Register extends Component
{
    public $mode;

    #[On('change-mode')]
    public function changeRegisterMode($mode)
    {
        $this->mode = $mode;
    }
    public function mount()
    {
        $this->mode = session('mode');
    }

    public function previewView()
    {
        return $this->redirect('/sales/view', navigate: true);
    }
    public function render()
    {
        return view('livewire.sale.option.register');
    }
}
