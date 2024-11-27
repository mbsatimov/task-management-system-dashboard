<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserGetPaginatedWithRolesAction
{
    public function __invoke(): LengthAwarePaginator
    {
        return User::with('roles')->paginate(10);
    }
}
