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
        $query = MedicalVisit::with(['patient', 'doctor']);
        if ($this->startDate && $this->endDate) {
            $query->whereBetween('visit_date', [$this->startDate, $this->endDate]);
        }
        return $query->orderBy('visit_date', 'asc')->get()
            ->map(function ($visit) {
                return [
                    'Visit Date' => $visit->visit_date,
                    'Patient Name' => $visit->patient->full_name,
                    'Doctor Assigned' => $visit->doctor->name,
                    'Appointment Type' => $visit->appointment_type,
                    'Status' => $visit->is_approved,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Visit Date',
            'Patient Name',
            'Doctor Assigned',
            'Appointment Type',
            'Status',
        ];
    }
}
