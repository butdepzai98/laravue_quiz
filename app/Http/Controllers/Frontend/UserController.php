<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ResultService;
use App\Services\ExamService;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $_resultService;
    protected $_examService;

    public function __construct(
        ResultService $resultService,
        ExamService $examService
    )
    {
        $this->middleware('auth');
        $this->_resultService = $resultService;
        $this->_examService = $examService;
    }

    public function profile()
    {
        return view('frontend.user.profile');
    }

    public function report($examId)
    {
        try {
            $exam = $this->_examService->findById($examId);
            $questions = $this->_resultService->report(Auth::id(), $examId);

            return view('frontend.user.report', [
                'questions' => $questions,
                'exam'    => $exam
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
