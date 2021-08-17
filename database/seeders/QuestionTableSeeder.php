<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;


class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        Question::factory()->count(750)->create()
        ->each(function($question) use ($faker){
            $answers = [];
            $corrects = [0,0,0,0];
            $corrects[array_rand([0,1,2,3])] = 1;

            for ($i=0; $i < 4; $i++) { 
                $answers[] = [
                    'question_id' => $question->id,
                    'content'     => $faker->text(50),
                    'correct'     => $corrects[$i],
                    'created_at'  => now(),
                    'updated_at'  => now(),
                ];
            }
            $question->answers()->insert($answers);
        });
    }
}
