<?php

namespace App\Actions;

use App\Models\Group;

class GroupDestroyAction
{
    public function __invoke(Group $group): Group
    {
        $group->delete();
        return $group;
    }
}
