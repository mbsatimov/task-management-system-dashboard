<?php

namespace App\Actions\StudentTask;

use App\Models\Task;

class StudentTaskGetAction
{
    /**
     * @param $user
     * @param int $taskId
     * @return Task
     */
    public function __invoke($user, int $taskId): Task
    {
        return $user->tasksAsStudent()->where('id', $taskId)->first();
    }
}
