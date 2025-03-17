<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalVisit;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use App\Exports\UserReportExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserReportCsvExport;
use App\Services\PdfService;

class UserReportController extends Controller
{
    protected $pdfService;

    public function __construct(PdfService $pdfService)
    {
        $this->pdfService = $pdfService;
        $this->middleware('permission:user-report-list|user-report-create|user-report-export', ['only' => ['index', 'generateReport']]);
        $this->middleware('permission:user-report-create', ['only' => ['generateReport']]);
        $this->middleware('permission:user-report-export', ['only' => ['exportReport', 'exportReportCsv', 'exportReportPdf']]);
    }

    public function generateReport(Request $request)
    {
        $userId = Auth::id();
        $patients = Patient::where('user_unique_id', $userId)->get();
        $selectedPatientId = $request->input('patient_id', $patients->first()->id ?? null);
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $userVisits = [];
        if ($selectedPatientId) {
            $query = MedicalVisit::where('patient_id', $selectedPatientId)->with(['doctor', 'nurse']);
            if ($startDate && $endDate) {
                $query->whereBetween('visit_date', [$startDate, $endDate]);
            }
            $userVisits = $query->get();
        }
        return view('reports.user', compact('patients', 'selectedPatientId', 'userVisits', 'startDate', 'endDate'));
    }

    public function exportReport(Request $request)
    {
        $userId = Auth::id();
        $patients = Patient::where('user_unique_id', $userId)->get();
        $selectedPatientId = $request->input('patient_id', $patients->first()->id ?? null);
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $userVisits = [];
        if ($selectedPatientId) {
            $query = MedicalVisit::where('patient_id', $selectedPatientId)->with(['doctor', 'nurse']);
            if ($startDate && $endDate) {
                $query->whereBetween('visit_date', [$startDate, $endDate]);
            }
            $userVisits = $query->get();
        }
        return Excel::download(new UserReportExport($userVisits, $patients, $selectedPatientId, $startDate, $endDate), 'user_report.xlsx');
    }

    public function exportReportCsv(Request $request)
    {
        $userId = Auth::id();
        $patients = Patient::where('user_unique_id', $userId)->get();
        $selectedPatientId = $request->input('patient_id', $patients->first()->id ?? null);
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $userVisits = [];
        if ($selectedPatientId) {
            $query = MedicalVisit::where('patient_id', $selectedPatientId)->with(['doctor', 'nurse']);
            if ($startDate && $endDate) {
                $query->whereBetween('visit_date', [$startDate, $endDate]);
            }
            $userVisits = $query->get();
        }
        return Excel::download(new UserReportCsvExport($userVisits, $patients, $selectedPatientId, $startDate, $endDate), 'user_report.csv');
    }

    public function exportReportPdf(Request $request)
    {
        $patientId = $request->input('patient_id');
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Fetch the data for the report
        $data = $this->generateReportData($patientId, $startDate, $endDate);

        // Generate the HTML for the report
        $html = view('reports.user_pdf', $data)->render();

        // Generate the PDF
        return $this->pdfService->generatePdf($html);
    }

    private function generateReportData($patientId, $startDate, $endDate)
    {
        $patient = Patient::find($patientId);

        $query = MedicalVisit::where('patient_id', $patientId)->with(['doctor']);
        if ($startDate && $endDate) {
            $query->whereBetween('visit_date', [$startDate, $endDate]);
        }
        $userVisits = $query->get();

        return compact('patient', 'userVisits', 'startDate', 'endDate');
    }
}
