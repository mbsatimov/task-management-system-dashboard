<?php

namespace App\Actions\User;

use App\Models\User;

class UserUpdateAction
{
    /**
     * @param User $user
     * @param array $data
     * @return void
     */
    public function __invoke(User $user, array $data): void
    {
        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update([
            'name' => $data['name'],
            'password' => $data['password'] ?? $user->password,
            'details' => [
                'student_number' => $data['student_number'] ?? null,
                'category_id' => $data['category_id'] ?? null,
            ]
        ]);
        $user->syncRoles($data['roles']);
    }
}
