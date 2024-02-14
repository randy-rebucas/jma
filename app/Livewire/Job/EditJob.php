<?php

namespace App\Livewire\Job;

use App\Models\Job;
use LivewireUI\Modal\ModalComponent;

class EditJob extends ModalComponent
{
    
    public $job_number;
    public $type;
    public $customerId;
    public $types = [];
    public $selectedType;

    public Job $job;

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }
    protected $rules = [
        'job_number' => 'required|string|max:255',
        'type' => 'required',
        'customerId' => 'required'
    ];
    protected $listeners = [
        'selectedCustomer'
    ];
    public function selectedCustomer($value)
    {
        $this->customerId = $value;
    }

    public function mount(Job $job)
    {
        $this->job = $job;

        $this->types = [
            '' => 'Select',
            'order' => 'Order',
            'estimate' => 'Estimate',
        ];

        $this->type = $this->job->type;
        $this->job_number = $this->job->job_number;
        $this->customerId = $this->job->customer->id;
    }

    public function isSelected($option)
    {
        return $option === $this->selected;
    }

    public function update(): void
    {
        $this->validate();

        $this->job->update([
            'job_number' => $this->job_number,
            'type' => $this->type,
            'customer_id' => $this->customerId
        ]);
        $this->dispatch('job-updated');

        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.job.edit-job');
    }
}
