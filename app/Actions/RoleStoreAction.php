<?php

namespace App\Actions;

use Spatie\Permission\Models\Role;

class RoleStoreAction
{
    public function __invoke(array $data): void
    {
        $role = Role::create($data);
        $role->syncPermissions($data['permissions']);
    }
}
