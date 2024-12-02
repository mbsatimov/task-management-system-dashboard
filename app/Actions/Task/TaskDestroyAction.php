<?php

namespace App\Actions\Task;

use App\Models\Task;

class TaskDestroyAction
{
    /**
     * @param Task $task
     * @return Task
     */
    public function __invoke(Task $task): Task
    {
        $task->delete();
        return $task;
    }
}
