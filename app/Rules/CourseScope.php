<?php

namespace App\Rules;

use App\Models\Course;
use Illuminate\Contracts\Validation\Rule;

class CourseScope implements Rule
{
    public function __construct(private string $value)
    {}

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value = null)
    {
        return method_exists(Course::class, 'scope' . ucfirst(strtolower(trim($this->value))));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The ' . $this->value . ' scope is invalid.';
    }
}