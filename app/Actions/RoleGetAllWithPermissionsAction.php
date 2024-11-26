<?php

namespace App\Actions;

use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

class RoleGetAllWithPermissionsAction
{
    public function __invoke(): Collection
    {
        return Role::with('permissions')->get();
    }
}
