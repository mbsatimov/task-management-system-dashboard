<?php

namespace App\Actions\Group;

use App\Models\Group;

class GroupGetWithUsersAction
{
    public function __invoke(Group $group): Group
    {
        $group->load('users');
        return $group;
    }
}
