<?php

namespace App\Actions\TaskCategory;

use App\Models\TaskCategory;

class TaskCategoryStoreAction
{
    public function __invoke(array $data): void
    {
        TaskCategory::create($data);
    }
}
