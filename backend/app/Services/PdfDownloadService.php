<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
 
class PdfDownloadService {
 
    public function generatePdfSalaryReport(array $salaryData)
    {
        $company = Company::find($salaryData['company']);
        $employees = Employee::whereRelation('companies', 'companies.id', '=', $company->id)->get()->groupBy('position');
        $emp = collect();

        foreach($employees as $employee){
            if($employee->first()->created_at > $salaryData['dateFrom'] && $employee->first()->created_at < $salaryData['dateTo'])
                $emp->push($employee);
        }

        $valuesByGroups = $emp->map(function ($row) {
            return array('position' => $row->first()->position, 'avg' => $row->avg('salary'), 'min' => $row->min('salary'), 'max' => $row->max('salary'), 'mediana' => $row->median('salary'));
        });

        $dateFrom = $salaryData['dateFrom'];
        $dateTo = $salaryData['dateTo'];

        $pdf = PDF::loadView('pdf.salaryreport', [
            'company' => $company->name,
            'salaries' => $valuesByGroups,
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
    	]);
 
        return $pdf;
    }
 
    public function generatePdfEmployeeMarkReport(array $markData)
    {
        $employee = Employee::find($markData['employee'])->name." ".Employee::find($markData['employee'])->surname;
        $position = Employee::find($markData['employee'])->position;
        $job_knowledge = $markData['job_knowledge'];
        $productivity = $markData['productivity'];
        $work_quality = $markData['work_quality'];
        $technical_skills = $markData['technical_skills'];
        $work_consistency = $markData['work_consistency'];
        $enthusiasm = $markData['enthusiasm'];
        $cooperation = $markData['cooperation'];
        $attitude = $markData['attitude'];
        $initiative = $markData['initiative'];
        $work_relations = $markData['work_relations'];
        $creativity = $markData['creativity'];
        $punctuality = $markData['punctuality'];
        $attendance = $markData['attendance'];
        $dependability = $markData['dependability'];
        $communication_skills = $markData['communication_skills'];
        $overall_rating = $markData['overall_rating'];
        $date = Carbon::now()->format('d-M-Y');
        $reviewer = $markData['reviewer'];
        $company = Employee::find($markData['employee'])->with('companies')->first()->name;
        $comment = $markData['reviewer_comment'];

        $pdf = PDF::loadView('pdf.markreport', [
    		"employee" => $employee,
            "position" => $position,
            "job_knowledge" => $job_knowledge,
            "productivity" => $productivity,
            "work_quality" => $work_quality,
            "technical_skills" => $technical_skills,
            "work_consistency" => $work_consistency,
            "enthusiasm" => $enthusiasm,
            "cooperation" => $cooperation,
            "attitude" => $attitude,
            "initiative" => $initiative,
            "work_relations" => $work_relations,
            "creativity" => $creativity,
            "punctuality" => $punctuality,
            "attendance" => $attendance,
            "dependability" => $dependability,
            "communication_skills" => $communication_skills,
            "overall_rating" => $overall_rating,
            "date" => $date,
            "reviewer" => $reviewer,
            "company" => $company,
            "comment" => $comment
    	]);
 
        return $pdf;
    }
}