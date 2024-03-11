<?php

namespace App\Livewire\Job\Option;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Job;

class Preview extends Component
{
    use WithPagination;

    public function registerView()
    {
        return $this->redirect('/jobs/register', navigate: true);
    }

    public function update($id)
    {
        $job = Job::find($id);
        $job->paid = $job->paid ? 0 : 1;
        $job->save();

        $this->dispatch('updateJob');
    }

    #[On('updateJob')]
    public function render()
    {
        $items = Job::paginate(10);
        // dd($items);
        return view('livewire.job.option.preview', compact('items'));
    }
}
