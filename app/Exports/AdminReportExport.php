<?php

namespace App\Exports;

use App\Models\MedicalVisit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminReportExport implements FromCollection, WithHeadings
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
        $query = MedicalVisit::with(['patient', 'doctor', 'nurse']);
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('visit_date', [$this->startDate, $this->endDate]);
        }
        return $query->orderBy('visit_date', 'asc')->get()
            ->map(function ($visit) {
                return [
                    'Medical Visit ID' => $visit->id,
                    'Patient Name' => $visit->patient->full_name,
                    'Patient ID' => $visit->patient->pat_unique_id,
                    'Doctor Name' => $visit->doctor->name,
                    'Nurse Name' => $visit->nurse->name,
                    'Visit Date' => $visit->visit_date,
                    'Appointment Type' => $visit->appointment_type,
                    'Medical Status' => $visit->medical_status,
                    'Approval Status' => $visit->is_approved,
                    'Diagnosis' => $visit->diagnosis,
                    'Medications Prescribed' => $visit->medications_prescribed,
                    'Procedures' => $visit->procedures,
                    'Emergency Case?' => $visit->is_emergency,
                    'Created By' => $visit->created_by,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Medical Visit ID',
            'Patient Name',
            'Patient ID',
            'Doctor Name',
            'Nurse Name',
            'Visit Date',
            'Appointment Type',
            'Medical Status',
            'Approval Status',
            'Diagnosis',
            'Medications Prescribed',
            'Procedures',
            'Emergency Case?',
            'Created By',
        ];
    }
}
