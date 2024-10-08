<?php

namespace App\Livewire\Supplier;

use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Models\User;
use App\Models\Supplier;
use Faker\Generator as Faker;
class CreateSupplier extends ModalComponent
{
    
    public $first_name;
    public $last_name;
    public $phone_number;
    public $company_name;
    public $comments;

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
        'company_name' => 'required',
        'comments' => 'string|max:1000',
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

        $validated['user_id'] = $user->id;

        Supplier::create($validated);

        $this->dispatch('supplier-created');

        $this->closeModal();
    }
    public function render()
    {
        return view('livewire.supplier.create-supplier');
    }
}
