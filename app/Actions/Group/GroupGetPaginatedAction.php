<?php

namespace App\Actions\Group;

use App\Http\Requests\GroupGetPaginatedRequest;
use App\Models\Group;
use Illuminate\Pagination\LengthAwarePaginator;

class GroupGetPaginatedAction
{
    /**
     * @param GroupGetPaginatedRequest $request
     * @return LengthAwarePaginator
     */
    public function __invoke(GroupGetPaginatedRequest $request): LengthAwarePaginator
    {
        $query = Group::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->whereRaw('name ilike ?', ["%$search%"]);
        }

        return $query->paginate(20)->withQueryString();
    }
}
