<!------------------- Validate Rule ------------------>

php artisan make:request Api/ExamRequest

    public function authorize()
    {
        return true;
    }

- all Rules :   https://laravel.com/docs/8.x/validation#using-rule-objects