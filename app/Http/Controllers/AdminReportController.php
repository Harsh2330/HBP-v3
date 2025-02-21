<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalVisit;
use App\Models\Patient;
use App\Models\User;

class AdminReportController extends Controller
{
    public function generateReport()
    {
        $totalPatients = Patient::count();
        $totalVisits = MedicalVisit::count();
        $approvedVisits = MedicalVisit::where('is_approved', 'Approved')->count();
        $pendingVisits = MedicalVisit::where('is_approved', 'Pending')->count();
        $emergencyCases = MedicalVisit::where('is_emergency', true)->count();

        $appointments = MedicalVisit::with(['patient', 'doctor'])->get();
        $doctorPerformance = User::role('Doctor')->withCount('medicalVisits')->get();

        return view('reports.admin', compact('totalPatients', 'totalVisits', 'approvedVisits', 'pendingVisits', 'emergencyCases', 'appointments', 'doctorPerformance'));
    }
}
