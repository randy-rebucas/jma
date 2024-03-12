<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use LivewireUI\Modal\ModalComponent;

class EditEmployee extends ModalComponent
{
    public $first_name;
    public $last_name;
    public $phone_number;
    public Employee $employee;
    public $employeeId;

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
    protected $rules = [
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone_number' => 'required'
    ];
    public function mount()
    {
        $this->employee = Employee::findOrFail($this->employeeId);

        $this->first_name = $this->employee->first_name; // or however you have it.
        $this->last_name = $this->employee->last_name;
        $this->phone_number = $this->employee->phone_number;

    }

    public function update(): void
    {
        $validated = $this->validate();

        $this->employee->update($validated);

        $this->dispatch('employee-updated');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.employee.edit-employee');
    }
}
