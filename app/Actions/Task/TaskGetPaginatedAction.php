<?php

namespace App\Actions\Task;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskGetPaginatedAction
{
    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function __invoke(Request $request): LengthAwarePaginator
    {
        $query = Task::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('title', 'like', "%$search%");
        }

        return $query->with(['category', 'mentor'])->withCount('students')->paginate(20)->withQueryString();
    }
}
