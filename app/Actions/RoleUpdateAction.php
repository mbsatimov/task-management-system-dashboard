<?php

namespace App\Actions;

use Spatie\Permission\Models\Role;

class RoleUpdateAction
{
    public function __invoke(Role $role, array $data, array $permissions): void
    {
        $role->update($data);
        $role->syncPermissions($permissions);
    }
}
