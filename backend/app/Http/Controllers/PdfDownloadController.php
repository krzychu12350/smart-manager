<?php

namespace App\Http\Controllers;

use App\Services\PdfDownloadService;
use App\Http\Requests\SalaryPdfRequest;
use App\Http\Requests\FormMarkPdfRequest;

class PdfDownloadController extends Controller
{
    public function downloadPdfSalaryReport(SalaryPdfRequest $request, PdfDownloadService $service)
    {
        $pdfFile = $service->generatePdfSalaryReport($request->validated());

        return $pdfFile->download('salary-report.pdf');
    }

    public function downloadPdfEmployeeMarkReport(FormMarkPdfRequest $request, PdfDownloadService $service)
    {
        $pdfFile = $service->generatePdfEmployeeMarkReport($request->validated());

        return $pdfFile->download('mark-report.pdf');
    }
}
