<?php

namespace App\Livewire\Employee\Block;

use App\Models\Employee;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Role;

class AssignRole extends ModalComponent
{
    public Employee $employee;
    public $employeeId;
    public $roles = [];

    public $role;

    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public static function closeModalOnEscape(): bool
    {
        return false;
    }

    public static function closeModalOnClickAway(): bool
    {
        return false;
    }

    public static function closeModalOnEscapeIsForceful(): bool
    {
        return false;
    }

    public static function destroyOnClose(): bool
    {
        return true;
    }

    protected $rules = [
        'role' => 'required'
    ];

    public function mount()
    {
        $this->roles = Role::all()->pluck('name', 'name');
        $this->employee = Employee::findOrFail($this->employeeId);
    }

    public function submit()
    {
        $this->validate();

        $this->employee->user->assignRole($this->role);

        $this->dispatch('role-updated');

        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.employee.block.assign-role');
    }
}
