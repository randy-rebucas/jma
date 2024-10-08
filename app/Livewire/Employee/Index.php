<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public $search;

    public function delete($id): void
    {
        $employee = Employee::find($id);
        $employee->delete();

        $this->dispatch('employee-deleted');
    }

    public function onView($employee_id)
    {
        return $this->redirectRoute('employee-detail', ['employeeId' => $employee_id]);
    }

    #[On('employee-created')]
    #[On('employee-updated')]
    #[On('employee-deleted')]
    public function render()
    {
        $employees = Employee::search('first_name', $this->search)->paginate(10);
        return view('livewire.employee.index', compact('employees'));
    }
}
