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
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'details' => [
                'student_number' => $data['student_number'] ?? null,
                'category_id' => $data['category_id'] ?? null,
            ]
        ]);
        $user->syncRoles($data['roles']);
    }
}
