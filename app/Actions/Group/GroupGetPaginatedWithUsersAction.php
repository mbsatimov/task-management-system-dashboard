<?php

namespace App\Actions\Group;

use App\Models\Group;
use Illuminate\Pagination\LengthAwarePaginator;

class GroupGetPaginatedWithUsersAction
{
    /**
     * @return LengthAwarePaginator
     */
    public function __invoke(): LengthAwarePaginator
    {
        return Group::with('users')->paginate(20);
    }

}
