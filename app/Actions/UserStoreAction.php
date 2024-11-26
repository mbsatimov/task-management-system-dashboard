<?php

namespace App\Actions;

use App\Models\User;

class UserStoreAction
{
    public function __invoke(array $data, array $roles): User
    {
        $user = User::create($data);
        $user->syncRoles($roles);

        return $user;
    }
}
