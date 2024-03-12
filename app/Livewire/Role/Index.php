<?php

namespace App\Livewire\Role;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Spatie\Permission\Models\Role;


#[Layout('layouts.app')]
class Index extends Component
{
    public function render()
    {
        $roles = Role::all()->pluck('name');

        return view('livewire.role.index', compact('roles'));
    }
}
