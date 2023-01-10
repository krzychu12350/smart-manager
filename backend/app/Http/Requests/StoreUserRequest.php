<?php

namespace App\Http\Requests;

class StoreUserRequest extends ApiFormRequest
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
            'name' => "required|string",
            'surname' => "required|string",
            'position' => "required|string",
            'salary' => "required|integer|min:4",
            'email' => "required|email|unique:users",
            'password' => "required|confirmed|min:8|string",
            'is_owner' => 'required|boolean'
        ];
    }
}
