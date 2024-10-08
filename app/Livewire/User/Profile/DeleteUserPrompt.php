<?php

namespace App\Livewire\User\Profile;

use LivewireUI\Modal\ModalComponent;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
class DeleteUserPrompt extends ModalComponent
{
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
    public function render()
    {
        return view('livewire.user.profile.delete-user-prompt');
    }
}
