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
            "employee" => "required",
            "job_knowledge" => "required|string",
            "productivity" => "required|string",
            "work_quality" => "required|string",
            "technical_skills" => "required|string",
            "work_consistency" => "required|string",
            "enthusiasm" => "required|string",
            "cooperation" => "required|string",
            "attitude" => "required|string",
            "initiative" => "required|string",
            "work_relations" => "required|string",
            "creativity" => "required|string",
            "punctuality" => "required|string",
            "attendance" => "required|string",
            "dependability" => "required|string",
            "communication_skills" => "required|string",
            "overall_rating" => "required|string",
            "reviewer" => "required|string",
            "reviewer_comment" => "required|string|min:8"
        ];
    }
}
