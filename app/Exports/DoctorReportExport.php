<?php

namespace App\Exports;

use App\Models\MedicalVisit;
use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DoctorReportExport implements FromCollection, WithHeadings
{
    protected $doctorId;

    public function __construct($doctorId)
    {
        $this->doctorId = $doctorId;
    }

    public function collection()
    {
        return MedicalVisit::where('doctor_id', $this->doctorId)
            ->with(['patient', 'nurse'])
            ->get()
            ->map(function ($visit) {
                return [
                    'Visit Date' => $visit->visit_date,
                    'Patient Name' => $visit->patient->full_name,
                    'Age' => $visit->patient->age_category,
                    'Gender' => $visit->patient->gender,
                    'Complaint' => $visit->primary_complaint,
                    'Diagnosis' => $visit->diagnosis,
                    'Medications' => $visit->medications_prescribed,
                    'Status' => $visit->medical_status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Visit Date',
            'Patient Name',
            'Age',
            'Gender',
            'Complaint',
            'Diagnosis',
            'Medications',
            'Status',
        ];
    }
}
