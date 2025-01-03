<?php

namespace App\Actions\Role;

use Illuminate\Database\Eloquent\Collection;
use Spatie\Permission\Models\Role;

class RoleGetAllAction
{
    /**
     * @return Collection
     */
    public function __invoke(): Collection
    {
        return Role::get();
    }
}
