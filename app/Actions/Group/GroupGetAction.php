<?php

namespace App\Actions\Group;

use App\Models\Group;
use App\Models\User;

class GroupGetAction
{
    /**
     * @param Group $group
     * @return Group
     */
    public function __invoke(Group $group): Group
    {
        $users = User::where('details->group_id', $group->id)->get();
        $group->setAttribute('users', $users);
        return $group;
    }
}
