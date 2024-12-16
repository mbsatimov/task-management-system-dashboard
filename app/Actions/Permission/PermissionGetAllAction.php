<?php

namespace App\Actions\Permission;

use App\Http\Requests\PermissionGetAllRequest;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;

class PermissionGetAllAction
{
    /**
     * @param PermissionGetAllRequest $request
     * @return Collection
     */
    public function __invoke(PermissionGetAllRequest $request): Collection
    {
        $query = Permission::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%");
        }

        return $query->get();
    }
}
