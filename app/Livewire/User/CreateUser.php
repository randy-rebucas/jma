<?php

namespace App\Livewire\User;

use LivewireUI\Modal\ModalComponent;

class CreateUser extends ModalComponent
{
    public function render()
    {
        return view('livewire.user.create-user');
    }
}
