<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:30',
            'password' => 'required|string|min:6|max:40',
            'email' => 'required|email'
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'name.required' => 'поле name должно быть заполнено.',
            'name.max' => 'поле name должно содержать максимум 30 символов.',
            'name.string' => 'поле name является строкой.',

            'password.required' => 'поле password должно быть заполнено.',
            'password.min' => 'поле password должно содержать минимум 6 символов.',
            'password.max' => 'поле password должно содержать максимум 40 символов.',
            'password.string' => 'поле password является строкой.',

            'email.required' => 'некорректный email.',
            'email.string' => 'поле email является строкой.'
        ];
    }
}
