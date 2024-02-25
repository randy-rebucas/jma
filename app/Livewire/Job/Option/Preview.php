<?php

namespace App\Livewire\Job\Option;

use Livewire\Component;

class Preview extends Component
{
    public function registerView()
    {
        return $this->redirect('/jobs/register', navigate: true);
    }
    public function render()
    {
        return view('livewire.job.option.preview');
    }
}
