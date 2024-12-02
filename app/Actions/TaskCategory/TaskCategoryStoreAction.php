<?php

namespace App\Actions\TaskCategory;

use App\Models\TaskCategory;

class TaskCategoryStoreAction
{
    /**
     * @param array $data
     * @return void
     */
    public function __invoke(array $data): void
    {
        TaskCategory::create($data);
    }
}
