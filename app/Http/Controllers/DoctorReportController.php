<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalVisit;

class DoctorReportController extends Controller
{
    public function generateReport($doctorId)
    {
        $doctorVisits = MedicalVisit::where('doctor_id', $doctorId)->with(['patient', 'nurse'])->get();
        return view('reports.doctor', compact('doctorVisits'));
    }
}
