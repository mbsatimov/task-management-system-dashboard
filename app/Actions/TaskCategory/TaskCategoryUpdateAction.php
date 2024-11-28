<?php

namespace App\Actions\TaskCategory;

use App\Models\TaskCategory;

class TaskCategoryUpdateAction
{
    public function __invoke(TaskCategory $taskCategory, array $data): void
    {
        $taskCategory->update($data);
    }
}
