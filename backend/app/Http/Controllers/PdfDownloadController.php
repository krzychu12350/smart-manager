<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Income;
use App\Models\User;
use Carbon\Carbon;
use App\Services\PdfDownloadService;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Http\Requests\SalaryPdfRequest;
use App\Http\Requests\FormMarkPdfRequest;

class PdfDownloadController extends Controller
{
    public function downloadPdfSalaryReport(SalaryPdfRequest $request, PdfDownloadService $service){

        $pdfFile = $service->generatePdfSalaryReport($request->validated());

        return $pdfFile->download('salary-report.pdf');
    }

    public function downloadPdfEmployeeMarkReport(FormMarkPdfRequest $request, PdfDownloadService $service){

        $pdfFile = $service->generatePdfEmployeeMarkReport($request->validated());

        return $pdfFile->download('mark-report.pdf');
    }
}
