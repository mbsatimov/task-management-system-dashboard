<?php

namespace App\Actions\TaskCategory;

use App\Models\TaskCategory;

class TaskCategoryDestroyAction
{
    /**
     * @param TaskCategory $taskCategory
     * @return void
     */
    public function __invoke(TaskCategory $taskCategory): void
    {
        $taskCategory->delete();
    }
}
