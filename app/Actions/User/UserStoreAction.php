<?php

namespace App\Actions\User;

use App\Models\User;

class UserStoreAction
{
    /**
     * @param array $data
     * @return void
     */
    public function __invoke(array $data): void
    {
        $user = User::create($data);
        $user->syncRoles($data['roles']);
        if (in_array('student', $data['roles'])) {
            $user->student()->create([
                'student_number' => $data['student_number'],
            ]);
        }
        if (in_array('mentor', $data['roles'])) {
            $user->mentor()->create([
                'category_id' => $data['category_id'],
            ]);
        }
    }
}
