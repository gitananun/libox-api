<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StringBoolean implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return in_array($value, ['true', 'false']);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute boolean string is invalid.';
    }
}