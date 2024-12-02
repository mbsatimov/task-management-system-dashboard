<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class RoleUpdateAction
{
    /**
     * @param Role $role
     * @param array $data
     * @return void
     */
    public function __invoke(Role $role, array $data): void
    {
        $role->update($data);
        $role->syncPermissions($data['permissions']);
    }
}
