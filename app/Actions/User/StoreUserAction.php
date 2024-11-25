<?php

namespace App\Actions\User;

use App\Models\User;

class StoreUserAction
{
    public function __invoke(array $data, array $roles): User
    {
        $user = User::create($data);
        $user->syncRoles($roles);

        return $user;
    }
}
