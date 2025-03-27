<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserReportCsvExport implements FromCollection, WithHeadings
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

    public function collection()
    {
        return $this->userVisits->map(function ($visit) {
            return [
                'Visit Date' => $visit->visit_date,
                'Doctor' => $visit->doctor->name ?? 'N/A',
                'Complaint' => $visit->primary_complaint ?? 'N/A',
                'Diagnosis' => $visit->diagnosis ?? 'N/A',
                'Medications' => $visit->medications_prescribed ?? 'N/A',
                'Status' => $visit->is_approved ?? 'N/A',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Visit Date',
            'Doctor',
            'Complaint',
            'Diagnosis',
            'Medications',
            'Status',
        ];
    }
}
