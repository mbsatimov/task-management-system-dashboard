<?php

namespace App\Actions\Task;

use App\Http\Requests\TaskGetPaginatedRequest;
use App\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskGetPaginatedAction
{
    /**
     * @param TaskGetPaginatedRequest $request
     * @return LengthAwarePaginator
     */
    public function __invoke(TaskGetPaginatedRequest $request): LengthAwarePaginator
    {
        $query = Task::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereRaw('title ilike ?', ["%$search%"]);
        }

        return $query->with(['category', 'mentor'])->withCount('students')->paginate(20)->withQueryString();
    }
}
