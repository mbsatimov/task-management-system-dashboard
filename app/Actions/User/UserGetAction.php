<?php

namespace App\Actions\User;

use App\Models\User;

class UserGetAction
{
    /**
     * @param User $user
     * @return User
     */
    public function __invoke(User $user): User
    {
        $user->load('roles');

        return $user;
    }
}
