<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\QuestionService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\QuestionRequest;

class QuestionController extends Controller
{
    private $_questionService;

    function __construct(QuestionService $questionService)
    {
        $this->_questionService = $questionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $limit = $request->limit;
            $orderBy = [];

            if($request->column && $request->sort){
                $orderBy = [
                    'column' => $request->column,
                    'sort'  => $request->sort
                ];
            }

            $questions = $this->_questionService->getAll($limit, $orderBy);

            return response()->json([
                'status'    => true,
                'code'  => Response::HTTP_OK,
                'questions' => $questions->items(),
                'meta'  =>  [
                    'total'         => $questions->total(),
                    'per_page'      => $questions->perPage(),
                    'current_page'  => $questions->currentPage(),
                    'last_page'     => $questions->lastPage()
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
    public function store(QuestionRequest $request)
    {
        try {
            $question = $this->_questionService->save();

            return response()->json([
                'status'    => true,
                'code'      => Response::HTTP_OK,
                'question'  => $question
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $question = $this->_questionService->findById($id);

            return response()->json([
                'status'    => true,
                'code'      => Response::HTTP_OK,
                'question'  => $question
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
