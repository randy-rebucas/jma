<?php

namespace App\Livewire\Job\Option;

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
    public function render()
    {
        return view('livewire.job.option.register');
    }
}
