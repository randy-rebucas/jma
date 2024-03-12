<?php

namespace App\Livewire\Employee;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;
use Faker\Generator as Faker;

class CreateEmployee extends ModalComponent
{
    public $first_name;
    public $last_name;
    public $phone_number;

    public $name;
    public $email;
    public $password;

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
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'phone_number' => 'required',
        'name' => 'required|string|max:255',
        'email' => 'required|string|lowercase|email|max:255|unique:' . User::class,
        'password' => 'required|string'
    ];

    public function mount(Faker $faker)
    {
        $this->name = $faker->userName;
        $this->email = $faker->unique()->email;
        $this->password = Hash::make('password');
    }

    public function submit()
    {
        $validated = $this->validate();

        $validated['password'] = Hash::make($validated['password']);
        // Execution doesn't reach here if validation fails.
        $user = User::create($validated);

        $employee = Employee::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'user_id' => $user->id
        ]);

        $this->dispatch('employee-created');

        $this->closeModal();

        $this->redirectRoute('employee-detail', ['employeeId' => $employee->id]);
    }

    public function render()
    {
        return view('livewire.employee.create-employee');
    }
}
