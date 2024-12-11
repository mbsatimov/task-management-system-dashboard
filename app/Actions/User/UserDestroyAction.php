<?php

namespace App\Actions\User;

use App\Models\User;

class UserDestroyAction
{
    /**
     * @param User $user
     * @return User
     */
    public function __invoke(User $user): User
    {
        $user->delete();

        return $user;
    }
}
