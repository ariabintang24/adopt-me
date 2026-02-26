<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;


class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


        // Permission sederhana untuk admin
        $permissions = [
            'manage animals',
            'manage categories',
            'manage adoptions',
            'manage users',
        ];


        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }


        // Role Admin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());


        // Role Adopter (tidak perlu permission backend)
        Role::firstOrCreate(['name' => 'adopter']);
    }
}
