<?php

namespace Database\Seeders;

use App\Models\TaskCategory;
use Illuminate\Database\Seeder;

class TaskCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Frontend', 'Backend', 'Design', 'Testing', 'Mobile',
        ];

        foreach ($categories as $category) {
            TaskCategory::firstOrCreate(['name' => $category]);
        }
    }
}
