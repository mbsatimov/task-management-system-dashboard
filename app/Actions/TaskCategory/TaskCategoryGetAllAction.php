<?php

namespace App\Actions\TaskCategory;

use App\Models\TaskCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class TaskCategoryGetAllAction
{
    /**
     * @param Request $request
     * @return Collection
     */
    public function __invoke(Request $request): Collection
    {
        $query = TaskCategory::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }

        return $query->get();
    }
}
