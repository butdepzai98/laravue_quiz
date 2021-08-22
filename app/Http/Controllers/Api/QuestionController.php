<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\QuestionService;
use App\Services\AnswerService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Api\QuestionRequest;
use App\Models\Question;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    private $_questionService;
    private $_answerService;

    function __construct(
        QuestionService $questionService,
        AnswerService $answerService
    )
    {
        $this->_questionService = $questionService;
        $this->_answerService = $answerService;
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
            DB::beginTransaction();

            $question = $this->_questionService->save(null, $request->content);
            
            if($request->answers){
                foreach ($request->answers as $answer) {
                    $answer['question_id']  = $question->id;
                    $this->_answerService->save(null, $answer);
                }
            }

            $question->answers;
            DB::commit();
            return response()->json([
                'status'    => true,
                'code'      => Response::HTTP_OK,
                'question'  => $question
            ]);
        } catch (\Exception $e) {
            DB::rollback();

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
    public function update(QuestionRequest $request, $id)
    {
        try {
            DB::beginTransaction();
            $question = $this->_questionService->save($id, $request->content);

            $answerOldIds = Question::find($id)->answers->pluck('id')->toArray();
            $answerNewIds = [];

            if($request->answers){
                foreach ($request->answers as $answer) {
                    if(isset($answer['id']))
                    array_push($answerNewIds, $answer['id']);
                }
            }

            $answerRemoved = array_diff($answerOldIds, $answerNewIds);
            if(isset($answerRemoved)){
                $this->_answerService->delete($answerRemoved);
            }

            if($request->answers){
                foreach ($request->answers as $answer) {
                    $answer['question_id']  = $id;
    
                    if(isset($answer['id']))
                        $this->_answerService->save($answer['id'], $answer);    
                    else
                        $this->_answerService->save(null, $answer);
                }
            }

            $question->answers;
            DB::commit();
            return response()->json([
                'status'    => true,
                'code'      => Response::HTTP_OK,
                // 'answerOldIds'  => $answerOldIds,
                // 'answerNewIds'  => $answerNewIds,
                'answerRemoved'  => $answerRemoved,
                'question'  => $question,
            ]);
        } catch (\Exception $e) {

            DB::rollback();

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            Question::find($id)->answers()->delete();
            $this->_questionService->delete($id);

            DB::commit();
            return response()->json([
                'status'    => true,
                'code'      => Response::HTTP_OK,
                'message'   => "Delete question successfully."
            ]);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                'errors'    => [
                    'status'    => false,
                    'code'      => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'message'   => $e->getMessage(),
                ]
            ]);
        }
    }
}
