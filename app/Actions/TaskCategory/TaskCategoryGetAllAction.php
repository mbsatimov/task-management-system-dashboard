<?php

namespace App\Actions\TaskCategory;

use App\Models\TaskCategory;
use Illuminate\Support\Collection;

class TaskCategoryGetAllAction
{
    /**
     * @return Collection
     */
    public function __invoke(): Collection
    {
        return TaskCategory::all();
    }
}
