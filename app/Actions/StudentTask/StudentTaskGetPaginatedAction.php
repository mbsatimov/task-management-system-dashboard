<?php

namespace App\Actions\StudentTask;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class StudentTaskGetPaginatedAction
{
    /**
     * @param Request $request
     * @param $user
     * @return LengthAwarePaginator
     */
    public function __invoke(Request $request, $user): LengthAwarePaginator
    {
        $tasks = $user->tasksAsStudent();
        $query = $tasks->query();
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('title', 'like', "%$search%");
        }

        return $query->with(['category', 'mentor'])->paginate(20)->withQueryString();
    }
}
