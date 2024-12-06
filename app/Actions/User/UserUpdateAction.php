<?php

namespace App\Actions\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        $user->syncRoles($data['roles']);
        if (in_array('student', $data['roles'])) {
            $user->student()->update([
                'student_number' => $data['student_number'],
            ]);
        }
        if (in_array('mentor', $data['roles'])) {
            $user->mentor()->update([
                'category_id' => $data['category_id'],
            ]);
        }
    }
}
