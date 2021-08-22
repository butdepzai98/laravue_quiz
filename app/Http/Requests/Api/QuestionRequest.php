<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use App\Rules\NumberAnswersForEarchQuestion;
use App\Rules\MustOnlyOneCorrectAnswer;

class QuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'content'   => ['required', 'min:12', new NumberAnswersForEarchQuestion($request->answers)],
            'answers.*.content' => ['required', 'min: 3'],
            'answers' => [new MustOnlyOneCorrectAnswer($request->answers)],
            'answers.*.correct' => ['boolean'] 
        ];
    }

    /** 
        * In genneral, validate "Fail" will response to HomePage.
        * If we use API, we need define a method support for Responsive Json
    */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [
                'errors'    => [
                    'status'    => false,
                    'code'      => Response::HTTP_UNPROCESSABLE_ENTITY,
                    'message'   => $validator->errors(),
                ]
            ],Response::HTTP_UNPROCESSABLE_ENTITY
        ));
    }

    public function messages()
    {
        return [
            'answers.*.content.required'    => "Content of Answer mustn't blank =.=",
            'answers.*.content.min'    => "Content of Answer mustn't at least 3 character =.=",
        ];   
    }
}
