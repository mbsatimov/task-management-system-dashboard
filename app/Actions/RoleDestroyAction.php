<?php

namespace App\Actions;

use Spatie\Permission\Models\Role;

class RoleDestroyAction
{
    public function __invoke(Role $role): Role
    {
        $role->delete();
        return $role;
    }
}
