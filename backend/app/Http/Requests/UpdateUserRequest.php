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
            'name' => "required|string|min:2|max:30",
            'surname' => "required|string|min:2|max:30",
            'position' => "required|string|min:2|max:30",
            'salary' => "required|integer|min:4",
            'is_owner' => "required|boolean|digits_between:0,1",
        ];
    }
}
