<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormMarkPdfRequest extends ApiFormRequest
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
            "employee_id" => "required|digits_between:1,4",
            "job_knowledge" => "required|digits_between:1,4",
            "productivity" => "required|digits_between:1,4",
            "work_quality" => "required|digits_between:1,4",
            "technical_skills" => "required|digits_between:1,4",
            "work_consistency" => "required|digits_between:1,4",
            "enthusiasm" => "required|digits_between:1,4",
            "cooperation" => "required|digits_between:1,4",
            "attitude" => "required|digits_between:1,4",
            "initiative" => "required|digits_between:1,4",
            "work_relations" => "required|digits_between:1,4",
            "creativity" => "required|digits_between:1,4",
            "punctuality" => "required|digits_between:1,4",
            "attendance" => "required|digits_between:1,4",
            "dependability" => "required|digits_between:1,4",
            "communication_skills" => "required|digits_between:1,4",
            "overall_rating" => "required|digits_between:1,4",
            "reviewer_id" => "required|digits_between:1,4",
            "company_id" => "required|digits_between:1,4",
            "reviewer_comment" => "required|string|min:8|max:255"
        ];
    }
}
