<?php

namespace App\Http\Controllers;

use App\Models\MedicalVisit;
use App\Models\Patient;
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

        $visitData = [
            'pending' => MedicalVisit::where('medical_status', 'pending')->count(),
            'completed' => MedicalVisit::where('medical_status', 'completed')->count(),
            'cancelled' => MedicalVisit::where('medical_status', 'cancelled')->count(),
        ];

        $genderData = [
            'male' => Patient::where('gender', 'male')->count(),
            'female' => Patient::where('gender', 'female')->count(),
            'other' => Patient::where('gender', 'other')->count(),
        ];

        return view('doctor.dashboard', compact('totalMedicalVisits', 'todaysAppointments', 'visitData', 'genderData'));
    }
}
