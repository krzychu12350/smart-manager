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
            "employee_id" => "required|integer",
            "job_knowledge" => "required|integer",
            "productivity" => "required|integer",
            "work_quality" => "required|integer",
            "technical_skills" => "required|integer",
            "work_consistency" => "required|integer",
            "enthusiasm" => "required|integer",
            "cooperation" => "required|integer",
            "attitude" => "required|integer",
            "initiative" => "required|integer",
            "work_relations" => "required|integer",
            "creativity" => "required|integer",
            "punctuality" => "required|integer",
            "attendance" => "required|integer",
            "dependability" => "required|integer",
            "communication_skills" => "required|integer",
            "overall_rating" => "required|integer",
            "reviewer_id" => "required|integer",
            "company_id" => "required|integer",
            "reviewer_comment" => "required|string|min:8"
        ];
    }
}
