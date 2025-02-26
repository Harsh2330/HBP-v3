<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalVisit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DoctorReportExport;
use App\Exports\DoctorReportCsvExport;

class DoctorReportController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:doctor-report-list|doctor-report-create|doctor-report-export', ['only' => ['index', 'generateReport']]);
        $this->middleware('permission:doctor-report-create', ['only' => ['generateReport']]);  
        $this->middleware('permission:doctor-report-export', ['only' => ['exportReport', 'exportReportCsv']]); 

       
    }
    public function generateReport($doctorId, Request $request)
    {
        $doctor = User::find($doctorId);
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = MedicalVisit::where('doctor_id', $doctorId)->with(['patient', 'nurse']);
        if ($startDate && $endDate) {
            $query->whereBetween('visit_date', [$startDate, $endDate]);
        }
        $doctorVisits = $query->get();

        $summary = $this->getSummaryStatistics($doctorId);
        $vitalStats = $this->getVitalStatsSummary($doctorId);
        $treatments = $this->getTreatmentsAndProcedures($doctorId);
        $followUps = $this->getPendingFollowUps($doctorId);

        return view('reports.doctor', compact('doctor', 'doctorVisits', 'summary', 'vitalStats', 'treatments', 'followUps', 'startDate', 'endDate'));
    }

    public function generateLoggedInDoctorReport()
    {
        $doctorId = Auth::id();
        $doctor = User::find($doctorId);
        $doctorVisits = MedicalVisit::where('doctor_id', $doctorId)->with(['patient', 'nurse'])->get();
        $summary = $this->getSummaryStatistics($doctorId);
        $vitalStats = $this->getVitalStatsSummary($doctorId);
        $treatments = $this->getTreatmentsAndProcedures($doctorId);
        $followUps = $this->getPendingFollowUps($doctorId);

        return view('reports.doctor', compact('doctor', 'doctorVisits', 'summary', 'vitalStats', 'treatments', 'followUps'));
    }

    public function exportReport(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        return Excel::download(new DoctorReportExport($startDate, $endDate), 'doctor_report.xlsx');
    }

    public function exportLoggedInDoctorReport()
    {
        $doctorId = Auth::id();
        return Excel::download(new DoctorReportExport($doctorId), 'doctor_report.xlsx');
    }

    public function exportReportCsv(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        
        return Excel::download(new DoctorReportCsvExport($startDate, $endDate), 'doctor_report.csv');
    }

    public function exportLoggedInDoctorReportCsv()
    {
        $doctorId = Auth::id();
        return Excel::download(new DoctorReportCsvExport($doctorId), 'doctor_report.csv');
    }

    private function getSummaryStatistics($doctorId)
    {
        $totalPatients = MedicalVisit::where('doctor_id', $doctorId)->count();
        $emergencyCases = MedicalVisit::where('doctor_id', $doctorId)->where('is_emergency', true)->count();
        $pendingApprovals = MedicalVisit::where('doctor_id', $doctorId)->where('medical_status', 'pending')->count();
        $completedVisits = MedicalVisit::where('doctor_id', $doctorId)->where('medical_status', 'Completed')->count();

        return (object) [
            'total_patients' => $totalPatients,
            'emergency_cases' => $emergencyCases,
            'pending_approvals' => $pendingApprovals,
            'completed_visits' => $completedVisits,
        ];
    }

    private function getVitalStatsSummary($doctorId)
    {
        $avgHeartRate = MedicalVisit::where('doctor_id', $doctorId)->avg('heart_rate');
        $avgSugarLevel = MedicalVisit::where('doctor_id', $doctorId)->avg('sugar_level');
        $avgTemperature = MedicalVisit::where('doctor_id', $doctorId)->avg('temperature');
        $avgOxygenLevel = MedicalVisit::where('doctor_id', $doctorId)->avg('oxygen_level');

        return (object) [
            'avg_heart_rate' => $avgHeartRate,
            'avg_sugar_level' => $avgSugarLevel,
            'avg_temperature' => $avgTemperature,
            'avg_oxygen_level' => $avgOxygenLevel,
        ];
    }

    private function getTreatmentsAndProcedures($doctorId)
    {
        $commonDiagnoses = MedicalVisit::where('doctor_id', $doctorId)->select('diagnosis')->groupBy('diagnosis')->orderByRaw('COUNT(*) DESC')->limit(5)->pluck('diagnosis');
        $mostPrescribedMedications = MedicalVisit::where('doctor_id', $doctorId)->select('medications_prescribed')->groupBy('medications_prescribed')->orderByRaw('COUNT(*) DESC')->limit(5)->pluck('medications_prescribed');
        $proceduresPerformed = MedicalVisit::where('doctor_id', $doctorId)->select('procedures')->groupBy('procedures')->orderByRaw('COUNT(*) DESC')->limit(5)->pluck('procedures');

        return (object) [
            'common_diagnoses' => $commonDiagnoses,
            'most_prescribed_medications' => $mostPrescribedMedications,
            'procedures_performed' => $proceduresPerformed,
        ];
    }

    private function getPendingFollowUps($doctorId)
    {
        $upcomingAppointments = MedicalVisit::where('doctor_id', $doctorId)->where('preferred_visit_date', '>', now())->count();
        $recommendations = MedicalVisit::where('doctor_id', $doctorId)->pluck('doctor_notes')->filter()->unique();

        return (object) [
            'upcoming_appointments' => $upcomingAppointments,
            'recommendations' => $recommendations,
        ];
    }
}
