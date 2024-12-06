<?php

namespace App\Actions\User;

use App\Models\User;

class UserGetWithRolesAction
{
    /**
     * @param User $user
     * @return User
     */
    public function __invoke(User $user): User
    {
        $user->load('roles');
        if ($user->hasAllRoles('student')) {
            $user->load('student');
        }
        if ($user->hasAllRoles('mentor')) {
            $user->load(['mentor', 'mentor.category']);
        }

        return $user;
    }
}
