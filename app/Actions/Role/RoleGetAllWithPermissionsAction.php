<?php

namespace App\Actions\Role;

use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

class RoleGetAllWithPermissionsAction
{
    public function __invoke(): Collection
    {
        return Role::with('permissions')->get();
    }
}
