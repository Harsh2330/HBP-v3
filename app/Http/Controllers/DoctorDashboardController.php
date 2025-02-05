<?php

namespace App\Http\Controllers;

use App\Models\MedicalVisit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DoctorDashboardController extends Controller
{
    public function index(): View
    {
        $totalMedicalVisits = MedicalVisit::where('doctor_id', auth()->id())->count();

        return view('doctor.dashboard', compact('totalMedicalVisits'));
    }
}
