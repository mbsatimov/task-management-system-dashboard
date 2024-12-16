<?php

namespace App\Actions\Group;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class GroupGetPaginatedAction
{
    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function __invoke(Request $request): LengthAwarePaginator
    {
        $query = Group::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }

        return $query->with(['users'])->paginate(20)->withQueryString();
    }

}
