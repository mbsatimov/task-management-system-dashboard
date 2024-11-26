<?php

namespace App\Actions;

use Spatie\Permission\Models\Role;

class RoleStoreAction
{
    public function __invoke(array $data, array $permissions): void
    {
        $role = Role::create($data);
        $role->syncPermissions($permissions);
    }
}
