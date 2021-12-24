<?php

namespace App\Http\Requests;

use App\Rules\LanguageCode;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'nullable|max:255|unique:courses,title',
            'rating' => 'nullable|numeric|between:0.0,5.0',
            'price' => 'nullable|numeric|between:0.0,999.0',
            'length' => 'nullable|numeric|between:0.0,999.0',
            'badge_id' => 'nullable|int|exists:badges,id',
            'description' => 'nullable|min:20',
            'last_updated' => 'nullable|date',
            'language' => ['nullable', new LanguageCode],
            'image' => 'mimes:jpg,png,jpeg|max:5048',
            'lessons' => 'nullable|int|min:0|max:999',
            'certification' => 'nullable|boolean',

            'categories' => 'present|array|distinct',
            'categories.*' => 'int|exists:categories,id',

            'instructors' => 'present|array|distinct',
            'instructors.*' => 'int|exists:instructors,id',
        ];
    }
}