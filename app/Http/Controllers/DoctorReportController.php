<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalVisit;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DoctorReportController extends Controller
{
    public function generateReport($doctorId)
    {
        $doctor = User::find($doctorId);
        $doctorVisits = MedicalVisit::where('doctor_id', $doctorId)->with(['patient', 'nurse'])->get();
        $summary = $this->getSummaryStatistics($doctorId);
        $vitalStats = $this->getVitalStatsSummary($doctorId);
        $treatments = $this->getTreatmentsAndProcedures($doctorId);
        $followUps = $this->getPendingFollowUps($doctorId);

        return view('reports.doctor', compact('doctor', 'doctorVisits', 'summary', 'vitalStats', 'treatments', 'followUps'));
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
