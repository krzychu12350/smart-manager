<?php

namespace App\Http\Requests;

class UpdateEmployeeRequest extends ApiFormRequest
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
            'is_admin' => "required|boolean",
        ];
    }
}
