<?php

namespace App\Http\Requests;

class StoreCompanyRequest extends ApiFormRequest
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
            'name' => "required|string|max:50",
            'city' => "required|string|max:50",
            'industry' => "required|string|max:50",
            'description' => "required|string|min:10|max:255",
        ];
    }
}
