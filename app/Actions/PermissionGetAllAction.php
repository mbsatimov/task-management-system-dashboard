<?php

namespace App\Actions;

use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Permission;

class PermissionGetAllAction
{
    public function __invoke(): Collection
    {
        return Permission::get();
    }
}
