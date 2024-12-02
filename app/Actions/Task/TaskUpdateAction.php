<?php

namespace App\Actions\Task;

use App\Models\Task;
use Illuminate\Support\Facades\Hash;

class TaskUpdateAction
{
    /**
     * @param Task $task
     * @param array $data
     * @return void
     */
    public function __invoke(Task $task, array $data): void
    {
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $task->update($data);
        $task->users()->sync($data['user_ids']);
    }
}
