<?php

namespace App\Actions\Role;

use Spatie\Permission\Models\Role;

class RoleStoreAction
{
    /**
     * @param array $data
     * @return void
     */
    public function __invoke(array $data): void
    {
        $role = Role::create($data);
        $role->syncPermissions($data['permissions']);
    }
}
