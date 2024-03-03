<?php

namespace App\Livewire\Job;

use App\Enums\JobTypeEnum;
use Livewire\Component;
use App\Traits\CartSession;

class Mode extends Component
{
    use CartSession;

    public $mode;
    public $modes = [];

    public function changeMode($mode)
    {
        $this->setModeValue('job-mode', $mode);
        $this->dispatch('changeMode', mode: $mode);
    }

    public function onClickLists()
    {
        return $this->redirect('/jobs/view', navigate: true);
    }

    public function mount()
    {
        $this->modes = JobTypeEnum::toSelectArray();
    }

    public function render()
    {
        return view('livewire.job.mode');
    }
}
