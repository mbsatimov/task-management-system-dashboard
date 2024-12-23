<?php

namespace App\Actions\User;

use App\Http\Requests\UserGetPaginatedRequest;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserGetPaginatedAction
{
    /**
     * @param UserGetPaginatedRequest $request
     * @param string|null $role
     * @return LengthAwarePaginator
     */
    public function __invoke(UserGetPaginatedRequest $request, ?string $role = null): LengthAwarePaginator
    {
        $query = User::query();
        $query->where(function ($query) use ($request, $role) {
            // Search filter
            if ($request->has('search') && $request->search) {
                $search = $request->search;
                $query->where('name', 'ilike', "%$search%")
                    ->orWhere('email', 'ilike', "%$search%");
            }

            // Role filter
            if ($role) {
                $query->whereHas('roles', function ($subQuery) use ($role) {
                    $subQuery->where('name', $role);
                });
            }
        });
        return $query->with(['roles', 'category', 'group'])->paginate(20)->withQueryString();
    }
}
