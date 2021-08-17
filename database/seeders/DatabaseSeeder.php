<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserTableSeeder::class,
            QuestionTableSeeder::class,
            ExamTableSeeder::class,
            AssignQuestionToExamTableSeeder::class,
            UserPracticePerExamSeeder::class
        ]);
    }
}
