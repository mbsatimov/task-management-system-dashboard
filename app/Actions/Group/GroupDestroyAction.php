<?php

namespace App\Actions\Group;

use App\Models\Group;

class GroupDestroyAction
{
    /**
     * @param Group $group
     * @return Group
     */
    public function __invoke(Group $group): Group
    {
        $group->delete();
        return $group;
    }
}
