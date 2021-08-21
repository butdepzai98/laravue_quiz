<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ExamService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\ExamRequest;

class ExamController extends Controller
{
    private $_examService;

    public function __construct(ExamService $examService)
    {
        $this->_examService = $examService;    
    }

    /**
     * Display a listing of Exams.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $limit = $request->get('limit');
            
            $sort = $request->get('sort');
            $column = $request->get('column');
            $orderBy = [];
            if($sort && $column){
                $orderBy = [
                    'column'    =>  $column,
                    'sort'      =>  $sort
                ];
            }

            $examsPaginate = $this->_examService->getAll($limit, $orderBy);
            
            return response()->json([
                'status'    => true,
                'code'  => Response::HTTP_OK,
                'exams'  => $examsPaginate->items(),
                'meta'  => [
                    'total' => $examsPaginate->total(),
                    'perPage'   => $examsPaginate->perPage(),
                    'currentPage'   => $examsPaginate->currentPage()
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'errors'    => [
                    'status'    => false,
                    'code'      => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message'   => $e->getMessage(),
                ]
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamRequest $request)
    {
        try {
            $exam = $this->_examService->save(null, $request->name);

            return response()->json([
                'status'    => true,
                'code'  => Response::HTTP_OK,
                'exam'  => $exam
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => false,
                'code'   => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message'   => $e->getMessage()
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $exam = $this->_examService->findById($id);

            return response()->json([
                'status'    => true,
                'code'  => Response::HTTP_OK,
                'exam'  => $exam
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => false,
                'code'   => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message'   => $e->getMessage()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExamRequest $request, $id)
    {
        try {

            $exam = $this->_examService->save($id, $request->name);

            return response()->json([
                'status'    => true,
                'code'  => Response::HTTP_OK,
                'exam'  => $exam
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => false,
                'code'   => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message'   => $e->getMessage()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $exam = $this->_examService->findById($id);
            if($exam){
                $this->_examService->delete([$id]);
            }

            return response()->json([
                'status'    => true,
                'code'  => Response::HTTP_OK
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status'    => false,
                'code'   => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message'   => $e->getMessage()
            ]);
        }
    }
}
