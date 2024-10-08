<?php

namespace App\Livewire\Role;

use App\Models\Role;
use LivewireUI\Modal\ModalComponent;
use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Models\Role;

class CreateRole extends ModalComponent
{
    public $name;

    public $permissions = [];

    public $assigned_permissions = [];

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
        'name' => 'required|string|max:255'
    ];

    public function mount(){
        $this->permissions = Permission::all()->pluck('name');
    }

    public function submit()
    {
        $this->validate();

        Role::create([
            'name' => $this->name,
        ])->givePermissionTo($this->assigned_permissions);


        $this->dispatch('role-created');

        $this->closeModal();
    }


    public function render()
    {
        return view('livewire.role.create-role');
    }
}
