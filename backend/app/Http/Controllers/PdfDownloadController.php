<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class PdfDownloadController extends Controller
{
    public function index(){
        $pdf = PDF::loadView('pdf.sample', [
    		'title' => 'CodeAndDeploy.com Laravel Pdf Tutorial',
    		'description' => 'This is an example Laravel pdf tutorial.',
    		'footer' => 'by <a href="#">codeanddeploy.com</a>'
    	]);
    
        return $pdf->download('myfile.pdf');       
    }
}
