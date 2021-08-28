<?php 

namespace App\Services;

use App\Models\Exam;
use Illuminate\Support\Facades\DB;

class ExamService
{
    public function getAll($limit = 25, $orderBy = [])
    {
        $query = Exam::query()->with('questions');

        if($orderBy){
            $query->orderBy($orderBy['column'], $orderBy['sort']);
        }
        return $query->paginate($limit);
    }


    public function save($id = null, $data)
    {
        return Exam::updateOrCreate(
            [
                'id'    => $id
            ],
            [
                'name'  => $data
            ]
        ); 
    }

    public function findById($id)
    {
        return Exam::find($id);
    }

    public function delete($ids = [])
    {
        return Exam::destroy($ids);
    }

    public function assignQuestionToExam($id, $questions)
    {
        $questionIds = [];
        
        foreach ($questions as $value) {
            array_push($questionIds, $value["question_id"]);
        }
        $questionIds = array_unique($questionIds);

        foreach ($questionIds as $item) {
            DB::table('exam_question')->insert(
                [
                    'exam_id'       => $id,
                    'question_id'   => $item,
                    'created_at'    => now(),
                    'updated_at'    => now()
                ]
            );
        }
    }
}