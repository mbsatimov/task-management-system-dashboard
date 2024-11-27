<?php

namespace App\Actions;

use App\Models\Group;
use App\Models\User;

class GroupStoreAction
{
    public function __invoke(array $data): void
    {
        $group = Group::create($data);
        User::whereIn('id', $data['userIds'])->update(['group_id' => $group->id]);
    }
}
