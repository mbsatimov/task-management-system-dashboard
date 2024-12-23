<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'super-admin' => Permission::pluck('name')->toArray(),
            'admin' => [
                'create role', 'view role', 'update role',
                'view permission',
                'create user', 'view user', 'update user',
                'create task', 'view task', 'update task',
            ],
            'mentor' => [
                'create task', 'view task', 'update task',
                'view user',
            ],
            'student' => ['view task'],
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($permissions);
        }
    }
}
