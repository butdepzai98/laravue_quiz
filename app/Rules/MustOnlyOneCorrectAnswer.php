<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MustOnlyOneCorrectAnswer implements Rule
{
    private $answers;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    function __construct($answers)
    {
        $this->answers = $answers;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $corrects = 0;

        foreach ($this->answers as $item) {
            if($item['correct'] == true){
                $corrects++;
            }
        }

        return $corrects == 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Must only one correct Answer for earch Question ! =.=';
    }
}
