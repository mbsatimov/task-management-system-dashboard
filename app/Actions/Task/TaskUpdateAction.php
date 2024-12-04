<?php

namespace App\Actions\Task;

use App\Models\Task;

class TaskUpdateAction
{
    /**
     * @param Task $task
     * @param array $data
     * @return void
     */
    public function __invoke(Task $task, array $data): void
    {
        $task->update($data);
    }
}
