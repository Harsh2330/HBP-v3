<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\MedicalVisit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $totalPatients = Patient::where('user_unique_id', auth()->id())->count();
        $totalMedicalVisits = MedicalVisit::whereHas('patient', function ($query) {
            $query->where('user_unique_id', auth()->id());
        })->count();

        // Fetch patients created by the user
        $patients = Patient::where('user_unique_id', auth()->id())->get();

        // Fetch vitals data for the selected patient
        $selectedPatientId = $request->input('patient_id', $patients->first()->id ?? null);
        $vitalsData = [];
        if ($selectedPatientId) {
            $vitals = MedicalVisit::where('patient_id', $selectedPatientId)->get(['visit_date', 'sugar_level', 'heart_rate', 'temperature','oxygen_level']);
            $vitalsData = [
                'dates' => $vitals->pluck('visit_date'),
                'SugarLevel' => $vitals->pluck('sugar_level'),
                'heartRate' => $vitals->pluck('heart_rate'),
                'temperature' => $vitals->pluck('temperature'),
                'oxygen' => $vitals->pluck('oxygen_level'),
            ];
        }

        return view('user.dashboard', compact('totalPatients', 'totalMedicalVisits', 'patients', 'selectedPatientId', 'vitalsData'));
    }
}
