<?php

namespace App\Actions\TaskCategory;

use App\Models\TaskCategory;

class TaskCategoryUpdateAction
{
    /**
     * @param TaskCategory $taskCategory
     * @param array $data
     * @return void
     */
    public function __invoke(TaskCategory $taskCategory, array $data): void
    {
        $taskCategory->update($data);
    }
}
