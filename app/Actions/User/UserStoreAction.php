<?php

namespace App\Actions\User;

use App\Models\User;

class UserStoreAction
{
    public function __invoke(array $data): void
    {
        $user = User::create($data);
        $user->syncRoles($data['roles']);
    }
}
