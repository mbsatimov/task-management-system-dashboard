<?php

namespace App\Actions;

use App\Models\Group;

class GroupStoreAction
{
    public function __invoke(array $data): void
    {
        $group = Group::create($data);
        $group->syncUsers($data['users']);
    }
}
