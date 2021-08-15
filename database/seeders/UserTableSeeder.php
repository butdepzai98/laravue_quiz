<?php

namespace Database\Seeders;

use App\Models\Answer;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Answer::create([
            ['question_id' => 1, 'content' => 'Answer1', 'correct' => false],
            ['question_id' => 1, 'content' => 'Answer2 for Question1', 'correct' => true],
            ['question_id' => 1, 'content' => 'Answer3', 'correct' => false],
            ['question_id' => 1, 'content' => 'Answer4', 'correct' => false],

            ['question_id' => 2, 'content' => 'Answer1', 'correct' => false],
            ['question_id' => 2, 'content' => 'Answer2 for Question1', 'correct' => true],
            ['question_id' => 2, 'content' => 'Answer3', 'correct' => false],
            ['question_id' => 2, 'content' => 'Answer4', 'correct' => false],

            ['question_id' => 3, 'content' => 'Answer1', 'correct' => false],
            ['question_id' => 3, 'content' => 'Answer2 for Question1', 'correct' => false],
            ['question_id' => 3, 'content' => 'Answer3 for Ques3', 'correct' => true],
            ['question_id' => 3, 'content' => 'Answer4', 'correct' => false],
        ]);
    }
}
