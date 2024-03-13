<?php

namespace App\Livewire\Role;

use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EditRole extends ModalComponent
{

    public $name;
    public $permissions = [];
    public $assigned_permissions = [];
    public Role $role;
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
    protected $rules = [
        'name' => 'required|string|max:255'
    ];
    public function mount(Role $role)
    {
        $this->role = $role;
        $this->name = $this->role->name;
        $this->assigned_permissions = $this->role->permissions->pluck('name');

        $this->permissions = Permission::all();
    }

    public function update(): void
    {
        $this->validate();

        $this->role->update([
            'name' => $this->name
        ]);

        $this->role->syncPermissions($this->assigned_permissions);

        $this->dispatch('role-updated');

        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.role.edit-role');
    }
}
