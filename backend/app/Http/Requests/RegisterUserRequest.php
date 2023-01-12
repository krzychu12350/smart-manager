<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => "required|min:6",
            'surname' => "required|min:6",
            'password' => "required|min:8",
            'email' => "required|email|unique:users|min:6",
            'is_owner' => "required|boolean",
        ];
    }
}
