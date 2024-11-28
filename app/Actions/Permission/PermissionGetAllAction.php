<?php

namespace App\Actions\Permission;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;

class PermissionGetAllAction
{
    public function __invoke(Request $request): Collection
    {
        $query = Permission::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }

        return $query->get();
    }
}
