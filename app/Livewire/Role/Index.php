<?php

namespace App\Livewire\Role;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Spatie\Permission\Models\Role;
use Livewire\Attributes\On;


#[Layout('layouts.app')]
class Index extends Component
{

    public function delete($id): void
    {
        $role = \App\Models\Role::findOrFail($id);
        $role->delete();

        $this->dispatch('role-deleted');
    }

    #[On('role-created')]
    #[On('role-updated')]
    #[On('role-deleted')]
    public function render()
    {
        $roles = Role::all();

        return view('livewire.role.index', compact('roles'));
    }
}
