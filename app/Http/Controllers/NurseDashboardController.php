<?php

namespace App\Http\Controllers;

use App\Models\MedicalVisit;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class NurseDashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $totalMedicalVisits = MedicalVisit::where('nurse_id', $user->id)->count();

        $todaysAppointments = MedicalVisit::where('nurse_id', $user->id)
            ->whereDate('visit_date', Carbon::today())
            ->where('is_approved', 'approved')
            ->get();

        $visitData = [
            'pending' => MedicalVisit::where('nurse_id', $user->id)->where('medical_status', 'pending')->count(),
            'completed' => MedicalVisit::where('nurse_id', $user->id)->where('medical_status', 'completed')->count(),
            'cancelled' => MedicalVisit::where('nurse_id', $user->id)->where('medical_status', 'cancelled')->count(),
        ];

        $genderData = [
            'male' => MedicalVisit::where('nurse_id', $user->id)->whereHas('patient', function ($query) {
                $query->where('gender', 'male');
            })->count(),
            'female' => MedicalVisit::where('nurse_id', $user->id)->whereHas('patient', function ($query) {
                $query->where('gender', 'female');
            })->count(),
            'other' => MedicalVisit::where('nurse_id', $user->id)->whereHas('patient', function ($query) {
                $query->where('gender', 'other');
            })->count(),
        ];

        $nurseActivities = [
            'Administered medication to patient John Doe',
            'Assisted in surgery with Dr. Smith',
            'Conducted health check-up for Robert Brown'
        ];

        return view('nurse.dashboard', compact('totalMedicalVisits', 'todaysAppointments', 'visitData', 'genderData', 'nurseActivities'));
    }
}
