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

        Permission::create(['name' => 'pos.menu']);
        Permission::create(['name' => 'customer.menu']);
        Permission::create(['name' => 'supplier.menu']);
        Permission::create(['name' => 'item.menu']);
        Permission::create(['name' => 'sale.menu']);
        Permission::create(['name' => 'receiving.menu']);
        Permission::create(['name' => 'report.menu']);
        Permission::create(['name' => 'setting.menu']);
        Permission::create(['name' => 'role.menu']);
        Permission::create(['name' => 'user.menu']);

        $role1 = Role::create(['name' => 'SuperAdmin'])->givePermissionTo(Permission::all());
        $role2 = Role::create(['name' => 'Admin'])->givePermissionTo(['customer.menu', 'pos.menu', 'user.menu', 'item.menu', 'sale.menu', 'receiving.menu', 'role.menu', 'report.menu', 'supplier.menu']);
        $role3 = Role::create(['name' => 'Staff'])->givePermissionTo(['customer.menu', 'supplier.menu', 'item.menu', 'sale.menu', 'receiving.menu']);

        $user = \App\Models\User::factory()->create([
            'name' => 'superadmin',
            'email' => 'superadmin@jma.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($role1);

        $user = \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@jma.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($role2);

        $user = \App\Models\User::factory()->create([
            'name' => 'staff',
            'email' => 'staff@jma.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole($role3);

        $this->call([
            CountrySeeder::class,
            CitySeeder::class,
            // CategorySeeder::class,
            CustomerSeeder::class,
            SupplierSeeder::class,
        ]);
    }
}
