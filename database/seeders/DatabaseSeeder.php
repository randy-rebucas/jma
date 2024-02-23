<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
        ]);
        // Employee::factory(5)->create();

        Permission::create(['name' => 'pos.menu', 'group_name' => 'pos']);
        // Permission::create(['name' => 'employee.menu', 'group_name' => 'employee']);
        Permission::create(['name' => 'customer.menu', 'group_name' => 'customer']);
        Permission::create(['name' => 'supplier.menu', 'group_name' => 'supplier']);
        Permission::create(['name' => 'item.menu', 'group_name' => 'item']);
        Permission::create(['name' => 'sale.menu', 'group_name' => 'sale']);
        Permission::create(['name' => 'receiving.menu', 'group_name' => 'receiving']);
        Permission::create(['name' => 'report.menu', 'group_name' => 'report']);
        Permission::create(['name' => 'setting.menu', 'group_name' => 'setting']);
        Permission::create(['name' => 'roles.menu', 'group_name' => 'roles']);
        Permission::create(['name' => 'user.menu', 'group_name' => 'user']);

        Role::create(['name' => 'SuperAdmin'])->givePermissionTo(Permission::all());
        Role::create(['name' => 'Admin'])->givePermissionTo(['customer.menu', 'user.menu', 'supplier.menu']);
        Role::create(['name' => 'Account'])->givePermissionTo(['customer.menu', 'user.menu', 'supplier.menu']);
        Role::create(['name' => 'Manager'])->givePermissionTo(['item.menu', 'sale.menu', 'receiving.menu', 'report.menu']);

        $admin->assignRole('SuperAdmin');

        $this->call([
            CountrySeeder::class,
            CitySeeder::class,
        ]);
    }
}
