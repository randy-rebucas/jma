<?php

namespace App\Livewire\Job;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Validation\Rules;
use App\Models\Job;

class CreateJob extends ModalComponent
{
    public $job_number;
    public $type;
    public $customer;

    public $types = [];

    public $selected;

    protected $rules = [
        'job_number' => 'required|string|max:255',
        'type' => 'required',
        'customer' => 'required'
    ];
    public function mount()
    {
        $this->job_number = Str::upper(Str::random(16));
        $this->types = [
            ''=> 'Select',
            'order'=> 'Order',
            'estimate'=> 'Estimate',
        ];
    }

    public function isSelected($option)
    {
        return $option === $this->selected;
    }

    public function submit()
    {
        $this->validate();

        Job::create([
            'job_number' => $this->job_number,
            'type' => $this->type,
            'customer_id' => $this->customer
        ]);

        $this->dispatch('job-created');

        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.job.create-job');
    }
}
