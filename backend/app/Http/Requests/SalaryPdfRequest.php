<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalaryPdfRequest extends ApiFormRequest
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
            "company" => "required|integer",
            "date_from" => [
                'date_format:Y-m-d'
            ],
            "date_to" =>  [
                'date_format:Y-m-d',
                'after:date_from'
            ]
        ];
    }
}
