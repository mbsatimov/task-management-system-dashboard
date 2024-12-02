<?php

namespace App\Actions\User;

use App\Models\User;

class UserStoreAction
{
    /**
     * @param array $data
     * @return void
     */
    public function __invoke(array $data): void
    {
        $user = User::create($data);
        $user->syncRoles($data['roles']);
    }
}
