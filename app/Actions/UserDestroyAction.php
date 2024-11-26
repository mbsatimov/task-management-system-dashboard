<?php

namespace App\Actions;

use App\Models\User;

class UserDestroyAction
{
    public function __invoke(User $user): User
    {
        $user->delete();
        return $user;
    }
}
