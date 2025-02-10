<?php

namespace App\Http\Controllers;

use App\Models\MedicalVisit;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DoctorDashboardController extends Controller
{
    public function index(): View
    {
        $totalMedicalVisits = MedicalVisit::where('doctor_id', Auth::user()->id)->count();
        $todaysAppointments = MedicalVisit::whereDate('visit_date', Carbon::today())
            ->where('is_approved', 'approved')
            ->get();

        return view('doctor.dashboard', compact('totalMedicalVisits', 'todaysAppointments'));
    }
}
