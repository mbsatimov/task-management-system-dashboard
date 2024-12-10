<?php

namespace App\Actions\User;

use App\Models\User;

class UserGetWithRolesAction
{
    /**
     * @param User $user
     * @return array
     */
    public function __invoke(User $user): array
    {
        // Load roles and include specific fields from the details JSON
        $user = User::select(
            'id',
            'name',
            'email',
            'details->student_number as student_number',
            'details->category_id as category_id'
        )
            ->where('id', $user->id)
            ->with('roles') // Load roles relationship
            ->firstOrFail(); // Retrieve the specific user or fail

        return $user->toArray(); // Convert the user to array with selected fields
    }
}
