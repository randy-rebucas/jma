<?php

namespace App\Livewire\Job;

use LivewireUI\Modal\ModalComponent;

class EditJob extends ModalComponent
{
    public function render()
    {
        return view('livewire.job.edit-job');
    }
}
