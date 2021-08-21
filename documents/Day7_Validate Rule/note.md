<!------------------- Validate Rule ------------------>

php artisan make:request Api/ExamRequest

    public function authorize()
    {
        return true;
    }

- all Rules :   https://laravel.com/docs/8.x/validation#using-rule-objects


@ ---- Function support handle Error for Json -----------

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