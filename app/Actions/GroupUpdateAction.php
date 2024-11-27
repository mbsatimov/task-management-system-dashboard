<?php

namespace App\Actions;

use App\Models\Group;
use App\Models\User;

class GroupUpdateAction
{

    public function __invoke(Group $group, array $data): void
    {
        $group->update($data);
        User::where('group_id', $group->id)->whereNotIn('id', $data['userIds'])->update(['group_id' => null]);
        User::whereIn('id', $data['userIds'])->update(['group_id' => $group->id]);
    }
}
