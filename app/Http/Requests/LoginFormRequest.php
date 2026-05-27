<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class LoginFormRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => 'required',
            'password' => 'required'
            //
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Siz foydalanuvchi_ID ni kiritmadingiz.',
            'password.required' => 'Parolni kiritmadingiz.'
        ];
    }
}
