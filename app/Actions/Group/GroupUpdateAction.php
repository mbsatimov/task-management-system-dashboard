<?php

namespace App\Actions\Group;

use App\Models\Group;
use App\Models\User;

class GroupUpdateAction
{
    /**
     * @param Group $group
     * @param array $data
     */
    public function __invoke(Group $group, array $data): void
    {
        $group->update($data);
        User::where('group_id', $group->id)->whereNotIn('id', $data['user_ids'])->update(['group_id' => null]);
        User::whereIn('id', $data['user_ids'])->update(['group_id' => $group->id]);
    }
}
