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
        $task = Task::create([
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
