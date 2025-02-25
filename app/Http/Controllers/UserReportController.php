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
}
