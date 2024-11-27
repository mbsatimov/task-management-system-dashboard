<?php

namespace App\Actions;

use App\Models\Group;

class GroupUpdateAction
{

    public function __invoke(Group $group, array $data): void
    {
        $group->update($data);
        $group->syncUsers($data['users']);
    }
}
