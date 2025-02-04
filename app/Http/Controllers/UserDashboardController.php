<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\MedicalVisit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    public function index(): View
    {
        $totalPatients = Patient::where('user_unique_id', auth()->id())->count();
        $totalMedicalVisits = MedicalVisit::where('unique_id', auth()->id())->count();

        return view('user.dashboard', compact('totalPatients', 'totalMedicalVisits'));
    }
}
