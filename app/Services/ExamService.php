<?php 

namespace App\Services;

use App\Models\Exam;

class ExamService
{
    public function getAll($limit = 25, $orderBy = [])
    {
        $query = Exam::query();

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
}