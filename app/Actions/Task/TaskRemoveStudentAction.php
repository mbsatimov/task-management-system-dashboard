<?php

namespace App\Actions\Task;

use App\Models\Task;

class TaskRemoveStudentAction
{
    /**
     * @param int $taskId
     * @param int $studentId
     * @return void
     */
    public function __invoke(int $taskId, int $studentId): void
    {
        $task = Task::findOrFail($taskId);
        $task->students()->detach($studentId);
    }
}
