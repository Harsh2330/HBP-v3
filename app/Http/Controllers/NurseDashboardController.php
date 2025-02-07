<?php

namespace App\Http\Controllers;

use App\Models\MedicalVisit;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class NurseDashboardController extends Controller
{
    public function index(): View
    {
        $totalMedicalVisits = MedicalVisit::where('nurse_id', Auth::user()->id)->count();

        return view('nurse.dashboard', compact('totalMedicalVisits'));
    }
}
