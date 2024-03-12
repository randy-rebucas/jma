<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class Index extends Component
{
    public $search;

    public function render()
    {
        $users = User::search('name', $this->search)->paginate(10);

        return view('livewire.user.index', compact('users'));
    }
}
