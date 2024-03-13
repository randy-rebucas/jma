<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
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
        Permission::create(['name' => 'user.menu']);
        Permission::create(['name' => 'employee.menu']);
        Permission::create(['name' => 'role.menu']);
        
        $role1 = Role::create(['name' => 'SuperAdmin'])->givePermissionTo(Permission::all());

        $user = \App\Models\User::factory()->create([
            'name' => 'superadmin',
            'email' => 'superadmin@jma.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($role1);

        $this->call([
            CountrySeeder::class,
            CitySeeder::class,
            CustomerSeeder::class,
            SupplierSeeder::class,
        ]);
    }
}
