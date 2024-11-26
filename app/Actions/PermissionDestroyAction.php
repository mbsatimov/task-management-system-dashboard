<?php

namespace App\Actions;

use Spatie\Permission\Models\Permission;

class PermissionDestroyAction
{
    public function __invoke(Permission $permission): void
    {
        $permission->delete();
    }
}
