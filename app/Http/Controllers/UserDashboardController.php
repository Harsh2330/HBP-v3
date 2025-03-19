<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\MedicalVisit;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $totalPatients = Patient::where('user_unique_id', auth()->id())->count();
        $totalMedicalVisits = MedicalVisit::whereHas('patient', function ($query) {
            $query->where('user_unique_id', auth()->id());
        })->count();

        // Fetch patients created by the user
        $patients = Patient::where('user_unique_id', auth()->id())->get();

        // Fetch vitals data for the selected patient
        $selectedPatientId = $request->input('patient_id', $patients->first()->id ?? null);
        $dateRange = $request->input('date_range', 'month'); // Default to month
        $vitalsData = [];
        $currentHealth = null;
        $healthStatus = 'Unknown';
        if ($selectedPatientId) {
            $query = MedicalVisit::where('patient_id', $selectedPatientId);

            switch ($dateRange) {
                case 'day':
                    $query->selectRaw('DATE(visit_date) as period, AVG(sugar_level) as sugar_level, AVG(heart_rate) as heart_rate, AVG(temperature) as temperature, AVG(oxygen_level) as oxygen_level')
                          ->groupByRaw('DATE(visit_date)');
                    break;
                case 'week':
                    $query->selectRaw('YEARWEEK(visit_date) as period, AVG(sugar_level) as sugar_level, AVG(heart_rate) as heart_rate, AVG(temperature) as temperature, AVG(oxygen_level) as oxygen_level')
                          ->groupByRaw('YEARWEEK(visit_date)');
                    break;
                case 'year':
                    $query->selectRaw('YEAR(visit_date) as period, AVG(sugar_level) as sugar_level, AVG(heart_rate) as heart_rate, AVG(temperature) as temperature, AVG(oxygen_level) as oxygen_level')
                          ->groupByRaw('YEAR(visit_date)');
                    break;
                default: // month
                    $query->selectRaw('DATE_FORMAT(visit_date, "%Y-%m") as period, AVG(sugar_level) as sugar_level, AVG(heart_rate) as heart_rate, AVG(temperature) as temperature, AVG(oxygen_level) as oxygen_level')
                          ->groupByRaw('DATE_FORMAT(visit_date, "%Y-%m")');
                    break;
            }

            $vitals = $query->get();
            $vitalsData = [
                'periods' => $vitals->pluck('period'),
                'SugarLevel' => $vitals->pluck('sugar_level'),
                'heartRate' => $vitals->pluck('heart_rate'),
                'temperature' => $vitals->pluck('temperature'),
                'oxygen' => $vitals->pluck('oxygen_level'),
            ];

            // Fetch the latest vitals for current health status
            $latestVitals = MedicalVisit::where('patient_id', $selectedPatientId)
                ->latest('visit_date')
                ->first(['sugar_level', 'heart_rate', 'temperature', 'oxygen_level']);

            $currentHealth = $latestVitals ? [
                'sugar_level' => $latestVitals->sugar_level,
                'heart_rate' => $latestVitals->heart_rate,
                'temperature' => $latestVitals->temperature,
                'oxygen_level' => $latestVitals->oxygen_level,
            ] : null;

            // Determine health status based on vitals
            if ($currentHealth) {
                if (
                    $currentHealth['sugar_level'] >= 70 && $currentHealth['sugar_level'] <= 140 &&
                    $currentHealth['heart_rate'] >= 60 && $currentHealth['heart_rate'] <= 100 &&
                    $currentHealth['temperature'] >= 36.1 && $currentHealth['temperature'] <= 37.2 &&
                    $currentHealth['oxygen_level'] >= 95
                ) {
                    $healthStatus = 'Healthy';
                } elseif (
                    ($currentHealth['sugar_level'] > 140 && $currentHealth['sugar_level'] <= 180) ||
                    ($currentHealth['heart_rate'] > 100 && $currentHealth['heart_rate'] <= 110) ||
                    ($currentHealth['temperature'] > 37.2 && $currentHealth['temperature'] <= 37.5) ||
                    ($currentHealth['oxygen_level'] >= 90 && $currentHealth['oxygen_level'] < 95)
                ) {
                    $healthStatus = 'Mild Concern';
                } elseif (
                    ($currentHealth['sugar_level'] > 180 && $currentHealth['sugar_level'] <= 200) ||
                    ($currentHealth['heart_rate'] > 110 && $currentHealth['heart_rate'] <= 120) ||
                    ($currentHealth['temperature'] > 37.5 && $currentHealth['temperature'] <= 38) ||
                    ($currentHealth['oxygen_level'] >= 85 && $currentHealth['oxygen_level'] < 90)
                ) {
                    $healthStatus = 'Moderate Concern';
                } elseif (
                    ($currentHealth['sugar_level'] > 200 && $currentHealth['sugar_level'] <= 250) ||
                    ($currentHealth['heart_rate'] > 120 && $currentHealth['heart_rate'] <= 130) ||
                    ($currentHealth['temperature'] > 38 && $currentHealth['temperature'] <= 39) ||
                    ($currentHealth['oxygen_level'] >= 80 && $currentHealth['oxygen_level'] < 85)
                ) {
                    $healthStatus = 'Severe Concern';
                } elseif (
                    ($currentHealth['sugar_level'] > 250) ||
                    ($currentHealth['heart_rate'] > 130) ||
                    ($currentHealth['temperature'] > 39) ||
                    ($currentHealth['oxygen_level'] < 80)
                ) {
                    $healthStatus = 'Critical';
                } elseif (
                    $currentHealth['sugar_level'] > 300 ||
                    $currentHealth['heart_rate'] < 50 ||
                    $currentHealth['temperature'] < 35 ||
                    $currentHealth['oxygen_level'] < 70
                ) {
                    $healthStatus = 'Too Sick';
                } else {
                    $healthStatus = 'Invalid Data';
                }
            }
        }

        return view('user.dashboard', compact('totalPatients', 'totalMedicalVisits', 'patients', 'selectedPatientId', 'vitalsData', 'dateRange', 'currentHealth', 'healthStatus'));
    }
}
