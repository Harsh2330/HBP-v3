<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UserReportExport implements FromView
{
    protected $userVisits;
    protected $patients;
    protected $selectedPatientId;
    protected $startDate;
    protected $endDate;

    public function __construct($userVisits, $patients, $selectedPatientId, $startDate, $endDate)
    {
        $this->userVisits = $userVisits;
        $this->patients = $patients;
        $this->selectedPatientId = $selectedPatientId;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function view(): View
    {
        return view('exports.user_report', [
            'userVisits' => $this->userVisits->map(function ($visit) {
                return [
                    'Visit ID' => $visit->id,
                    'Visit Date' => $visit->visit_date,
                    'Doctor Name' => $visit->doctor->name,
                    'Symptoms Reported' => $visit->symptoms,
                    'Diagnosis' => $visit->diagnosis,
                    'Medications Prescribed' => $visit->medications_prescribed,
                    'Ongoing Treatments' => $visit->ongoing_treatments,
                    'Procedures' => $visit->procedures,
                    'Sugar Level' => $visit->sugar_level,
                    'Heart Rate' => $visit->heart_rate,
                    'Temperature' => $visit->temperature,
                    'Oxygen Level' => $visit->oxygen_level,
                    'Doctor Notes' => $visit->doctor_notes,
                ];
            }),
            'patients' => $this->patients,
            'selectedPatientId' => $this->selectedPatientId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate
        ]);
    }
}
