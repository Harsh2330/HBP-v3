<?php

namespace App\Http\Controllers;

use App\Services\PdfService;

class PdfController extends Controller
{
    protected $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
    }

    public function downloadPdf()
    {
        $html = '<h1>Hello, Laravel 11 with DOMPDF!</h1>';
        return $this->pdfService->generatePdf($html);
    }
}
    