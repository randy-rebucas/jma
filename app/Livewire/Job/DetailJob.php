<?php

namespace App\Livewire\Job;

use App\Models\Car;
use App\Models\Job;
use Livewire\Component;

class DetailJob extends Component
{
    public $jobs = [];

    public function mount(Car $car)
    {
        $this->jobs = Job::where('car_id', $car->id)->get();
    }

    public function render()
    {
        return view('livewire.job.detail-job');
    }
}
