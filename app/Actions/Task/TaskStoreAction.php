<?php

namespace App\Actions\Task;

use App\Models\Task;

class TaskStoreAction
{
    /**
     * @param array $data
     * @return void
     */
    public function __invoke(array $data): void
    {
        $task = Task::create($data);
        $task->users()->sync($data['user_ids']);
    }
}
