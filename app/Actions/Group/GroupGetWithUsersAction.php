<?php

namespace App\Actions\Group;

use App\Models\Group;

class GroupGetWithUsersAction
{
    /**
     * @param Group $group
     * @return Group
     */
    public function __invoke(Group $group): Group
    {
        $group->load('users');
        return $group;
    }
}
