<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class RoleDestroyAction
{
    public function __invoke(Role $role): Role
    {
        $role->delete();
        return $role;
    }
}
