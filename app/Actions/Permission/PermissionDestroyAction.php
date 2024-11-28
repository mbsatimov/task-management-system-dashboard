<?php

namespace App\Actions\Permission;

use Spatie\Permission\Models\Permission;

class PermissionDestroyAction
{
    public function __invoke(Permission $permission): void
    {
        $permission->delete();
    }
}
