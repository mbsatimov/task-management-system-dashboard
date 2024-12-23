<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('string123'),
                'role' => 'super-admin',
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('string123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Mentor1',
                'email' => 'mentor1@gmail.com',
                'password' => Hash::make('string123'),
                'role' => 'mentor',
                'category_id' => 1,
            ],
            [
                'name' => 'Mentor2',
                'email' => 'mentor2@gmail.com',
                'password' => Hash::make('string123'),
                'role' => 'mentor',
                'category_id' => 2,
            ],
            [
                'name' => 'Student1',
                'email' => 'student1@gmail.com',
                'password' => Hash::make('string123'),
                'role' => 'student',
                'student_number' => '122',
            ],
            [
                'name' => 'Student2',
                'email' => 'student2@gmail.com',
                'password' => Hash::make('string123'),
                'role' => 'student',
                'student_number' => '123',
            ],
            [
                'name' => 'Student3',
                'email' => 'student3@gmail.com',
                'password' => Hash::make('string123'),
                'role' => 'student',
                'student_number' => '124',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate([
                'email' => $userData['email'],
            ], [
                'name' => $userData['name'],
                'password' => $userData['password'],
            ]);

            $role = Role::where('name', $userData['role'])->first();
            if ($role) {
                $user->assignRole($role);
            }
        }
    }
}
