<?php

namespace App\Actions\Task;

use App\Models\Task;

class TaskGetWithTaskCategoryAction
{
    /**
     * @param Task $task
     * @return Task
     */
    public function __invoke(Task $task): Task
    {
        $task->load('category', 'mentor', 'students');
        return $task;
    }
}
