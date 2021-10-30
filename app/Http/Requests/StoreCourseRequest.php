<?php

namespace App\Http\Requests;

use App\Rules\LanguageCode;
use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255|unique:courses,title',
            'rating' => 'nullable|numeric|between:0.0,5.0',
            'price' => 'nullable|numeric|between:0.0,999.0',
            'length' => 'nullable|numeric|between:0.0,999.0',
            'description' => 'required|min:20',
            'last_updated' => 'nullable|date',
            'language' => ['required', new LanguageCode],
        ];
    }
}