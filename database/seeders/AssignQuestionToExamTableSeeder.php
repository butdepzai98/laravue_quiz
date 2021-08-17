<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Exam;
use App\Models\Question;

class AssignQuestionToExamTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $questionMaxId = 0;

        Exam::chunk(1, function($exams) use (&$questionMaxId){
            foreach ($exams as $key => $exam) {
                $questions = Question::where('id', '>', $questionMaxId)->take(25)->get();
                $questionMaxId = $questions->last()->id;

                if($questions->count()>0){
                    foreach ($questions as $question) {
                        $examQuestion[] = [
                            'exam_id'   =>  $exam->id,
                            'question_id'   =>  $question->id,
                            'created_at'    => now(),
                            'updated_at'    => now()
                        ];
                    }

                    DB::table('exam_question')->insert($examQuestion);
                }
            }
        });
    }
}
