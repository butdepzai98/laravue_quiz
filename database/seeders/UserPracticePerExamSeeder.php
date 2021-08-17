<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exam;
use App\Models\User;
use App\Models\Result;

class UserPracticePerExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::take(35)->get();

        foreach ($users as $user) {
            $exam = Exam::inRandomOrder()->first();

            if($exam->questions->count() > 0){
                foreach ($exam->questions as $question) {
                    $answer = $question->answers()->inRandomOrder()->first();

                    if(!empty($answer)){
                        $result = [
                            'exam_id'   =>  $exam->id,
                            'question_id'   =>  $question->id,
                            'answer_id'   =>  $answer->id,
                            'user_id'   =>  $user->id,
                            'created_at'    => now(),
                            'updated_at'    => now()
                        ];

                        Result::insert($result);
                    }
                }
            }
        }
    }
}
