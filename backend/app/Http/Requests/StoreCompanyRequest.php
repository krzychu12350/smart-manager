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
            'name' => "required|max:70",
            'city' => "required|max:70",
            'industry' => "required|max:70",
            'description' => "required|min:10",
        ];
    }
}
