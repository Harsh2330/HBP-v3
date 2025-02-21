<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalVisit;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class UserReportController extends Controller
{
    public function generateReport(Request $request)
    {
        $userId = Auth::id();
        $patients = Patient::where('user_unique_id', $userId)->get();
        $selectedPatientId = $request->input('patient_id', $patients->first()->id ?? null);
        $userVisits = [];
        if ($selectedPatientId) {
            $userVisits = MedicalVisit::where('patient_id', $selectedPatientId)->with(['doctor', 'nurse'])->get();
        }
        return view('reports.user', compact('patients', 'selectedPatientId', 'userVisits'));
    }
}
