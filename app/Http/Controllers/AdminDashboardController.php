<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use App\Models\MedicalVisit;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\View\View; // Add this import

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $totalUsers = User::count();
        $totalDoctors = User::role('doctor')->count();
        $totalNurses = User::role('nurse')->count();
        $totalPatients = Patient::count();
        $totalMedicalVisits = MedicalVisit::count();
        $auditLogs = AuditLog::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact('totalUsers', 'totalDoctors', 'totalNurses', 'totalPatients', 'totalMedicalVisits', 'auditLogs'));
    }
}
