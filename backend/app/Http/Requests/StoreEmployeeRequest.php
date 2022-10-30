<?php

namespace App\Http\Requests;

class StoreEmployeeRequest extends ApiFormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => "required|string|unique:App\Models\Employee",
            'surname' => "required|string|unique:App\Models\Employee",
            'position' => "required|string",
            'salary' => "required|integer|min:4",
            'email' => "required|email|unique:employees",
            'password' => "required|confirmed|min:8|string",
        ];
    }
}
