<?php

namespace App\Actions\TaskCategory;

use App\Http\Requests\TaskCategoryGetAllRequest;
use App\Models\TaskCategory;
use Illuminate\Support\Collection;

class TaskCategoryGetAllAction
{
    /**
     * @param TaskCategoryGetAllRequest $request
     * @return Collection
     */
    public function __invoke(TaskCategoryGetAllRequest $request): Collection
    {
        $query = TaskCategory::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }

        return $query->get();
    }
}
