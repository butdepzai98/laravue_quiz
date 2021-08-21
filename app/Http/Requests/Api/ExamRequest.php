<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Symfony\Component\HttpFoundation\Response;

class ExamRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name'  => 'required|min:5'
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

    /** 
     * In genneral, validate "Fail" will response English language
     * How to Customize this message
    */
   public function messages()
   {
           return [
                'name.required' => "Please input exam name =.=",
                'name.min' => "Name must at least 5 syntax =.=",
           ];
   }
}
