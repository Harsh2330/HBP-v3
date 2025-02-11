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
        $user = Auth::user();
        $totalMedicalVisits = MedicalVisit::count();

        if (!MedicalVisit::where('doctor_id', $user->id)->exists()) {
            $todaysAppointments = MedicalVisit::whereDate('visit_date', Carbon::today())
            ->where('is_approved', 'approved')
            ->get();
        } else {
            $todaysAppointments = MedicalVisit::where('doctor_id', $user->id)
                ->whereDate('visit_date', Carbon::today())
                ->where('is_approved', 'approved')
                ->get();
        }

        return view('doctor.dashboard', compact('totalMedicalVisits', 'todaysAppointments'));
    }
}
