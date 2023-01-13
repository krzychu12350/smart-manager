<?php

namespace App\Http\Requests;

class UpdateUserRequest extends ApiFormRequest
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
            'name' => "string",
            'surname' => "string",
            'position' => "string",
            'salary' => "integer|min:4",
            'is_owner' => "required|boolean",
            //'email' => "required|email|unique:users",
            //'password' => "required|confirmed|min:8|string",
        ];
    }
}
