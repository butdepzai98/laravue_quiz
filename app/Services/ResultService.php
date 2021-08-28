<?php 
namespace App\Services;

use App\Models\Question;
use App\Models\Result;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ResultService
{
    protected $_result;

    function __construct(Result $result)
    {
        $this->_result = $result;    
    }

    public function save($answers, $examId)
    {
        if(isset($answers)){
            foreach ($answers as $questionId => $answer) {
                DB::table('results')->insert(
                    [
                        "exam_id"       => $examId,
                        "question_id"   => $questionId,
                        "answer_id"     => $answer,
                        "user_id"       => Auth::id(),
                        "created_at"    => now(),
                        "updated_at"    => now()
                    ]
                );
            }
        }
    }

    public function report($userId, $examId)
    {
        $query = Question::join('exam_question', 'exam_question.question_id', 'questions.id')
            ->join('results', 'results.question_id', 'questions.id')
            ->where('results.exam_id', $examId)
            ->select('questions.*', 'results.answer_id', 'results.user_id')
            ->with('answers');
        // $query = Question::join('exam_question', 'exam_question.question_id', 'questions.id')
        //     ->join('results', 'results.question_id', 'questions.id')
        //     ->whereRaw("('results.user_id' = $userId AND 'results.exam_id' = $examId)")
        //     ->select('questions.*', 'results.answer_id', 'results.user_id')
        //     ->with('answers');
        
        return $query->get();
    }
}