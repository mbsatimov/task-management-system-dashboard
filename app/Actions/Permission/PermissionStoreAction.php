<?php

namespace App\Actions\Permission;

use Spatie\Permission\Models\Permission;

class PermissionStoreAction
{
    public function __invoke(array $data): void
    {
        Permission::create($data);
    }
}
