<?php

namespace App\Actions;

use Spatie\Permission\Models\Permission;

class PermissionUpdateAction
{
    public function __invoke(Permission $permission, array $data): void
    {
        $permission->update($data);
    }
}
