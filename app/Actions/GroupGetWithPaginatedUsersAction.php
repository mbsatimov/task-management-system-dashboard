<?php

namespace App\Actions;

use App\Models\Group;

class GroupGetWithPaginatedUsersAction
{
    public function __invoke(Group $group): Group
    {
        $group->load('users');
        return $group;
    }
}
