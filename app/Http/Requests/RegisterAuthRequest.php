<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAuthRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date_of_birth' => 'nullable|date',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
        ];
    }
}