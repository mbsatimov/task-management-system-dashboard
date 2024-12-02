<?php

namespace App\Actions\Permission;

use Spatie\Permission\Models\Permission;

class PermissionDestroyAction
{
    /**
     * @param Permission $permission
     * @return void
     */
    public function __invoke(Permission $permission): void
    {
        $permission->delete();
    }
}
