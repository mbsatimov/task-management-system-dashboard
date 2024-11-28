<?php

namespace App\Actions\TaskCategory;

use App\Models\TaskCategory;

class TaskCategoryDestroyAction
{
    public function __invoke(TaskCategory $taskCategory): void
    {
        $taskCategory->delete();
    }
}
