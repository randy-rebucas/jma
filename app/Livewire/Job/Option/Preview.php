<?php

namespace App\Livewire\Job\Option;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Job;

class Preview extends Component
{
    use WithPagination;

    public function registerView()
    {
        return $this->redirect('/jobs/register', navigate: true);
    }

    public function render()
    {
        $items = Job::paginate(10);

        return view('livewire.job.option.preview', compact('items'));
    }
}
