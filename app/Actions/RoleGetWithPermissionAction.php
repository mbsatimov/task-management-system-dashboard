<?php

namespace App\Actions;

use Spatie\Permission\Models\Role;

class RoleGetWithPermissionAction
{
    public function __invoke(Role $role): Role
    {
        $role->load('permission');
        return $role;
    }
}
