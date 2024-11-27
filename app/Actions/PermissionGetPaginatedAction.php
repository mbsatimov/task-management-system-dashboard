<?php

namespace App\Actions;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Spatie\Permission\Models\Permission;

class PermissionGetPaginatedAction
{
    public function __invoke(Request $request): LengthAwarePaginator
    {
        $query = Permission::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }

        return $query->paginate(20)->withQueryString();
    }
}
