<?php

namespace App\Actions;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserGetPaginatedAction
{
    public function __invoke(): LengthAwarePaginator
    {
        return User::with('roles')->paginate(10);
    }
}
