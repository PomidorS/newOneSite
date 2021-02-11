<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'text' => 'required|string|max:255 '
        ];
    }


    public function messages(): array
    {
        return [
            'text' => 'текст в посте должен содержать максимум 255 символов '
        ];
    }
}
