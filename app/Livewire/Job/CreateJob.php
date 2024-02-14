<?php

namespace App\Livewire\Job;

use App\Models\Customer;
use Illuminate\Support\Str;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Validation\Rules;
use App\Models\Job;

class CreateJob extends ModalComponent
{
    public $job_number;
    public $type;
    public $customerId;
    public $types = [];
    public $selectedType;

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

    public function mount()
    {
        $this->job_number = Str::upper(Str::random(16));
        $this->types = [
            '' => 'Select',
            'order' => 'Order',
            'estimate' => 'Estimate',
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
            'customer_id' => $this->customerId
        ]);

        $this->dispatch('job-created');

        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.job.create-job');
    }
}
