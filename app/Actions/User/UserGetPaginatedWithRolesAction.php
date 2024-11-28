<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserGetPaginatedWithRolesAction
{
    public function __invoke(Request $request): LengthAwarePaginator
    {
        $query = User::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        }

        return $query->with(['roles', 'group'])->paginate(20)->withQueryString();
    }
}
