<?php 
namespace App\Services;

use App\Models\Question;

class QuestionService
{
    public function getAll($limit = 25, $orderBy = [])
    {
        $query = Question::query()->with('answers');

        if($orderBy){
            $query->orderBy($orderBy['column'], $orderBy['sort']);
        }

        return $query->paginate($limit); 
    }


    public function save()
    {

    }

    public function findById($id)
    {   
        $question = Question::find($id);
        $answers = $question->answers;

        return $question;
    }
}