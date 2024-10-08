<?php

namespace App\Livewire\Setup;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

#[Layout('layouts.guest')]
class Index extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'customer.menu']);
        Permission::create(['name' => 'supplier.menu']);
        Permission::create(['name' => 'item.menu']);
        Permission::create(['name' => 'job.menu']);
        Permission::create(['name' => 'sale.menu']);
        Permission::create(['name' => 'receiving.menu']);
        Permission::create(['name' => 'report.menu']);
        Permission::create(['name' => 'setting.menu']);
        Permission::create(['name' => 'role.menu']);
        Permission::create(['name' => 'user.menu']);
        Permission::create(['name' => 'expense.menu']);
        Permission::create(['name' => 'employee.menu']);
        
        $role = Role::create(['name' => 'super-admin'])->givePermissionTo(Permission::all());

        $user->assignRole($role);

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }

    public function render()
    {
        return view('livewire.setup.index');
    }
}
