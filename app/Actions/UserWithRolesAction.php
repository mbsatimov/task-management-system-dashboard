<?php

namespace App\Actions;

use App\Models\User;

class UserWithRolesAction
{
    public function __invoke(User $user): User
    {
        $user->load('roles');
        return $user;
    }
}
