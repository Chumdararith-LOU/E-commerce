<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'users.manage',
            'products.create',
            'products.update',
            'products.delete',
            'categories.create',
            'categories.update',
            'categories.delete',
        ];

        foreach ($permissions as $permissionName) {
            Permission::firstOrCreate(['name' => $permissionName]);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $managerRole = Role::firstOrCreate(['name' => 'manager']);
        $staffRole = Role::firstOrCreate(['name' => 'staff']);

        $adminRole->permissions()->sync(Permission::all());

        $managerPermissions = Permission::where('name', '!=', 'users.manage')->get();
        $managerRole->permissions()->sync($managerPermissions);

        
        $admin = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('12345678'),
            ]
        );
        $admin->roles()->sync([$adminRole->id]);

        $manager = User::firstOrCreate(
            ['email' => 'manager@test.com'],
            [
                'name' => 'Manager User',
                'password' => Hash::make('12345678'),
            ]
        );
        $manager->roles()->sync([$managerRole->id]);

        $staff1 = User::firstOrCreate(
            ['email' => 'staff1@test.com'],
            [
                'name' => 'Staff One',
                'password' => Hash::make('12345678'),
            ]
        );
        $staff1->roles()->sync([$staffRole->id]);

        $staff2 = User::firstOrCreate(
            ['email' => 'staff2@test.com'],
            [
                'name' => 'Staff Two',
                'password' => Hash::make('12345678'),
            ]
        );
        $staff2->roles()->sync([$staffRole->id]);
    }
}
