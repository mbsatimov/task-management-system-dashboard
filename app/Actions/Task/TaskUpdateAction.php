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
        $task->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'video' => $data['video'],
            'deadline' => $data['deadline'],
            'category_id' => $data['category_id'],
            'mentor_id' => $data['mentor_id'],
        ]);

        $task->students()->attach($data['student_ids']);
    }
}
