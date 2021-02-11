<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestComment extends FormRequest
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
            'text' => 'required|string|max:1024 '
        ];
    }


    public function messages(): array
    {
        return [
            'text' => 'текст комментария должен содержать максимум 1024 символа '
        ];
    }
}
