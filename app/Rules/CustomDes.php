<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CustomDes implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        // return strpos($value, 'ngon bo re') !== false;
        if (strpos($value, 'ngon bo re') !== false) {
            $flag = true;
        } else {
            $flag = false;
        }

        return $flag;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The description has contain "ngon bo re".';
    }
}
