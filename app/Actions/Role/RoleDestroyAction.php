<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class RoleDestroyAction
{
    /**
     * @param Role $role
     * @return Role
     */
    public function __invoke(Role $role): Role
    {
        $role->delete();
        return $role;
    }
}
