<?php

namespace App\Actions\Group;

use App\Models\Group;
use App\Models\User;

class GroupStoreAction
{
    /**
     * @param array $data
     * @return void
     */
    public function __invoke(array $data): void
    {
        $group = Group::create($data);
        User::whereIn('id', $data['user_ids'])->update(['details->group_id' => $group->id]);
    }
}
