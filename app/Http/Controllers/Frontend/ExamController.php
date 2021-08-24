<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ExamService;

class ExamController extends Controller
{
    protected $_examService;

    function __construct(ExamService $examService)
    {
        $this->_examService = $examService;
    }

    public function index()
    {
        $exams = $this->_examService->getAll();
        return view('frontend.exam.index', ['exams' => $exams]);
    }

    public function show($id)
    {
        $exam = $this->_examService->findById($id);
        return view('frontend.exam.show', ['exam' => $exam]);
    }
}
