<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UserGetPaginatedWithRolesAction
{
    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function __invoke(Request $request): LengthAwarePaginator
    {
        $query = User::query();
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%");
        }

        return $query->select('id', 'name', 'email', 'details->student_number as student_number', 'details->category_id as category_id')->with('roles')->paginate(20)->withQueryString();
    }
}
