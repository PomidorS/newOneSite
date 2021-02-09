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
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:30',
            'password' => 'required|min:6|max:40',
            'email' => 'required|email'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'поле name должно содержать максимум 30 символов',
            'password.required' => 'поле password должно содержать минимум 6 и максимум 40 символов',
            'email.required' => 'некорректный email'
        ];
    }
}
