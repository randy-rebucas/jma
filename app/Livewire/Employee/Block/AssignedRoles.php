<?php

namespace App\Livewire\Employee\Block;

use App\Models\Employee;
use Livewire\Component;
use Livewire\Attributes\On;

class AssignedRoles extends Component
{
    public Employee $employee;

    public function delete($role): void
    {
        $this->employee->user->removeRole($role);
        $this->dispatch('role-updated');
    }

    #[On('role-updated')]
    public function render()
    {
        return view('livewire.employee.block.assigned-roles');
    }
}
