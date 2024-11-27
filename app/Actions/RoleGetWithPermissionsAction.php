<?php

namespace App\Actions;

use Spatie\Permission\Models\Role;

class RoleGetWithPermissionsAction
{
    public function __invoke(Role $role): Role
    {
        $role->load('permissions');
        return $role;
    }
}
