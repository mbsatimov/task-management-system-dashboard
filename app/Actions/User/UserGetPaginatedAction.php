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
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        }
        if ($role) {
            $query->whereHas('roles', function ($query) use ($role) {
                $query->where('name', $role);
            });
        }

        return $query->with(['roles'])->paginate(20)->withQueryString();
    }
}
