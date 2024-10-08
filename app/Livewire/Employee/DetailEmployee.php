<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout('layouts.app')]
class DetailEmployee extends Component
{
    public Employee $employee;

    public function mount($employeeId)
    {
        $this->employee = Employee::findOrFail($employeeId);
    }

    public function render()
    {
        return view('livewire.employee.detail-employee');
    }
}
