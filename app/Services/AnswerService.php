<?php 
namespace App\Services;

use App\Models\Answer;

class AnswerService
{
    public function save($id = null, $data)
    {
        return Answer::updateOrCreate(
            [
                'id'    => $id
                
            ],
            [
                'question_id'   => $data['question_id'],
                'content'       => $data['content'],
                'correct'       => $data['correct']
            ]
        ); 
    }

    public function delete($ids = [])
    {
        return Answer::destroy($ids);
    }
}