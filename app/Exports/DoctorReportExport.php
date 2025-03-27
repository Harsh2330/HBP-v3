<?php

namespace App\Exports;

use App\Models\MedicalVisit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DoctorReportExport implements FromCollection, WithHeadings
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        $query = MedicalVisit::with(['patient', 'doctor']);
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('visit_date', [$this->startDate, $this->endDate]);
        }
        return $query->orderBy('visit_date', 'asc')->get()
            ->map(function ($visit) {
                return [
                    'Patient Name' => $visit->patient->full_name,
                    'Patient ID' => $visit->patient->pat_unique_id,
                    'Visit Date' => $visit->visit_date,
                    'Appointment Type' => $visit->appointment_type,
                    'Symptoms' => $visit->symptoms,
                    'Diagnosis' => $visit->diagnosis,
                    'Simplified Diagnosis' => $visit->simplified_diagnosis,
                    'Medications Prescribed' => $visit->medications_prescribed,
                    'Ongoing Treatments' => $visit->ongoing_treatments,
                    'Procedures' => $visit->procedures,
                    'Sugar Level' => $visit->sugar_level,
                    'Heart Rate' => $visit->heart_rate,
                    'Temperature' => $visit->temperature,
                    'Oxygen Level' => $visit->oxygen_level,
                    'Doctor Notes' => $visit->doctor_notes,
                    'Medical Status' => $visit->medical_status,
                    'Emergency Case?' => $visit->is_emergency,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Patient Name',
            'Patient ID',
            'Visit Date',
            'Appointment Type',
            'Symptoms',
            'Diagnosis',
            'Simplified Diagnosis',
            'Medications Prescribed',
            'Ongoing Treatments',
            'Procedures',
            'Sugar Level',
            'Heart Rate',
            'Temperature',
            'Oxygen Level',
            'Doctor Notes',
            'Medical Status',
            'Emergency Case?',
        ];
    }
}
