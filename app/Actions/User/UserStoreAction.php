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
            'category_id' => $data['category_id'] ?? null,
            'student_number' => $data['student_number'] ?? null,
            'password' => bcrypt($data['password']),
        ]);
        $user->syncRoles($data['roles']);
    }
}
