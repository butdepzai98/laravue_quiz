<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ExamService;
use App\Services\ResultService;
use Illuminate\Support\Facades\DB;
use App\Models\Result;

class ExamController extends Controller
{
    protected $_examService;
    protected $_resultService;

    function __construct(
        ExamService $examService,
        ResultService $resultService
    )
    {
        $this->_examService = $examService;
        $this->_resultService = $resultService;
        $this->middleware('auth');
    }

    public function index()
    {
        $bgs = [
            "bg-primary",
            "bg-success",
            "bg-info",
            "bg-warning",
            "bg-danger",
            "bg-secondary",
            "bg-dark"
        ];
        $exams = $this->_examService->getAll();

        // dd($exams);

        return view('frontend.exam.index', [
            'exams' => $exams,
            'bgs'   => $bgs
        ]);
    }

    public function show($id)
    {
        $exam = $this->_examService->findById($id);
        return view('frontend.exam.show', ['exam' => $exam]);
    }

    public function submit(Request $request, $examId)
    {
        try {
            DB::beginTransaction();

            if($request->answers){
                $this->_resultService->save($request->answers, $examId);
                return redirect(route('user.report', ['exam_id' => $examId]));
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return($e->getMessage());
        }
    }
}
