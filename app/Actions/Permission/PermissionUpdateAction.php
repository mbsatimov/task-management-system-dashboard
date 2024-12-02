<?php

namespace App\Actions\Permission;

use Spatie\Permission\Models\Permission;

class PermissionUpdateAction
{
    /**
     * @param Permission $permission
     * @param array $data
     * @return void
     */
    public function __invoke(Permission $permission, array $data): void
    {
        $permission->update($data);
    }
}
