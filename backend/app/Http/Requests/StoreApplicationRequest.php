<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class StoreApplicationRequest extends ApiFormRequest
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
            'status' => [
                "required",
                Rule::in(['accepted', 'in progress', 'rejected']),
            ],
            'company_id' => "required|integer",
            'employee_id' => "required|integer",
        ];
    }
}
