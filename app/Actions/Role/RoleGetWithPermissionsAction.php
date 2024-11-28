<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class RoleGetWithPermissionsAction
{
    public function __invoke(Role $role): Role
    {
        $role->load('permissions');
        return $role;
    }
}
