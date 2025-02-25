<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalVisit;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdminReportExport;
use App\Exports\AdminReportCsvExport;

class AdminReportController extends Controller
{
    public function generateReport(Request $request)
    {
        $dateRange = $request->input('date_range', 'monthly');
        $visitSelection = $request->input('visit_selection', 'all');

        $totalPatients = Patient::count();
        $totalVisits = MedicalVisit::count();
        $approvedVisits = MedicalVisit::where('is_approved', 'Approved')->count();
        $pendingVisits = MedicalVisit::where('is_approved', 'Pending')->count();
        $emergencyCases = MedicalVisit::where('is_emergency', true)->count();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = MedicalVisit::with(['patient', 'doctor']);
        if ($startDate && $endDate) {
            $query->whereBetween('visit_date', [$startDate, $endDate]);
        }
        $appointments = $query->orderBy('visit_date', 'asc')->get();

        $doctorPerformance = User::role('Doctor')->get()->map(function ($doctor) {
            $doctor->patients_seen = MedicalVisit::where('doctor_id', $doctor->id)->count();
            $doctor->pending_visits = MedicalVisit::where('doctor_id', $doctor->id)->where('medical_status', 'pending')->count();
            $doctor->completed_visits = MedicalVisit::where('doctor_id', $doctor->id)->where('medical_status', 'Completed')->count();
            $doctor->emergency_visits = MedicalVisit::where('doctor_id', $doctor->id)->where('is_emergency', true)->count();
            return $doctor;
        });

        // Additional data for the new sections
        $malePatients = Patient::where('gender', 'Male')->count();
        $femalePatients = Patient::where('gender', 'Female')->count();
        $otherGenderPatients = Patient::where('gender', 'Other')->count();

        $childrenCount = Patient::where('age_category', '0-9')->count();
        $teenagersCount = Patient::where('age_category', '10-19')->count();
        $adultsCount = Patient::whereIn('age_category', ['20-29', '30-39', '40-49', '50-59'])->count();
        $seniorsCount = Patient::whereIn('age_category', ['60-69', '70-79', '80+'])->count();

        $topDiagnoses = DB::table('medical_visits')
            ->select('diagnosis as name')
            ->groupBy('diagnosis')
            ->orderBy('visit_date', 'desc')
            ->limit(5)
            ->get();

        $topMedications = DB::table('medical_visits')
            ->select('medications_prescribed as name')
            ->groupBy('medications_prescribed')
            ->orderBy('visit_date', 'desc')
            ->limit(5)
            ->get();

        $commonProcedures = DB::table('medical_visits')
            ->select('procedures as name')
            ->groupBy('procedures')
            ->orderBy('visit_date', 'desc')
            ->limit(5)
            ->get();

        return view('reports.admin', compact(
            'totalPatients', 'totalVisits', 'approvedVisits', 'pendingVisits', 'emergencyCases', 
            'appointments', 'doctorPerformance', 'malePatients', 'femalePatients', 'otherGenderPatients', 
            'childrenCount', 'teenagersCount', 'adultsCount', 'seniorsCount', 'startDate', 'endDate',
            'topDiagnoses', 'topMedications', 'commonProcedures'
        ));
    }

  
    public function exportAdminReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        return Excel::download(new AdminReportExport($startDate, $endDate), 'admin_report.xlsx');
    }

    public function exportAdminReportCsv(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        return Excel::download(new AdminReportCsvExport($startDate, $endDate), 'admin_report.csv');
    }
}
