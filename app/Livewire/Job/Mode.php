<?php

namespace App\Livewire\Job;

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
        session()->put('job-mode', $mode);
    }

    public function getMode() {
        if (!session('job-mode')) {
            $this->setMode(config('settings.job_register_mode'));
        }

        return session('job-mode');
    }

    public function onClickLists()
    {
        return $this->redirect('/jobs/view', navigate: true);
    }

    public function mount()
    {
        $this->modes['order'] = 'Order';
        $this->modes['estimate'] = 'Estimate';

        $this->mode = $this->getMode();
    }

    public function render()
    {
        return view('livewire.job.mode');
    }
}
