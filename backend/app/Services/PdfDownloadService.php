<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Company;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PdfDownloadService
{
    public function generatePdfSalaryReport(array $salaryData)
    {
        $company = Company::findOrFail($salaryData['company']);
        $usersWithIncomesGroupByPositions = User::join('incomes', 'incomes.user_id', 'users.id')
            ->whereRelation('companies', 'companies.id', '=', $company->id)
            ->where('is_owner', false)->where('incomes.created_at', '>', $salaryData['dateFrom'])
            ->where('incomes.created_at', '<', $salaryData['dateTo'])
            ->get()->groupBy('position');
        $valuesByGroups = $usersWithIncomesGroupByPositions->map(function ($row) {
            return array(
                'position' => $row->first()->position,
                'avg' => round($row->avg('amount'), 0),
                'min' => $row->min('amount'),
                'max' => $row->max('amount'),
                'mediana' => $row->median('amount'));
        });

        return PDF::loadView('pdf.salaryreport', [
            'company' => $company->name,
            'salaries' => $valuesByGroups,
            'dateFrom' => $salaryData['dateFrom'],
            'dateTo' => $salaryData['dateTo'],
        ]);
    }

    public function generatePdfEmployeeMarkReport(array $markData): \Barryvdh\DomPDF\PDF
    {
        $employee = User::findOrFail($markData['employee_id']);
        $reviewer = User::findOrFail($markData['reviewer_id']);
        $company = User::findOrFail($markData['company_id']);

        return PDF::loadView('pdf.markreport', [
            "employee" => $employee->name . " " . $employee->surname,
            "position" => $employee->position,
            "job_knowledge" => $markData['job_knowledge'],
            "productivity" => $markData['productivity'],
            "work_quality" => $markData['work_quality'],
            "technical_skills" => $markData['technical_skills'],
            "work_consistency" => $markData['work_consistency'],
            "enthusiasm" => $markData['enthusiasm'],
            "cooperation" => $markData['cooperation'],
            "attitude" => $markData['attitude'],
            "initiative" => $markData['initiative'],
            "work_relations" => $markData['work_relations'],
            "creativity" => $markData['creativity'],
            "punctuality" => $markData['punctuality'],
            "attendance" => $markData['attendance'],
            "dependability" => $markData['dependability'],
            "communication_skills" => $markData['communication_skills'],
            "overall_rating" => $markData['overall_rating'],
            "date" => Carbon::now()->format('d-M-Y'),
            "reviewer" => $reviewer->name . " " . $reviewer->surname,
            "company" => $company->name,
            "comment" => $markData['reviewer_comment']
        ]);
    }
}
