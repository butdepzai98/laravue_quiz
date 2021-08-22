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


    public function save($id, $data)
    {
        return Question::updateOrCreate(
            [
                'id'    => $id
            ],
            [
                'content'  => $data
            ]
        ); 
    }

    public function findById($id)
    {   
        $question = Question::find($id);
        $answers = $question->answers;

        return $question;
    }

    public function delete($ids = [])
    {
        return Question::destroy($ids);
    }
}