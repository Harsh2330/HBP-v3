<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DoctorReportCsvExport implements FromCollection, WithHeadings
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
        // Fetch data based on the date range
        // This is just a placeholder, replace with actual data fetching logic
        return collect([
            ['Visit Date', 'Patient Name', 'Complaint', 'Diagnosis', 'Medications', 'Status'],
            ['2023-01-01', 'John Doe', 'Headache', 'Migraine', 'Painkillers', 'Completed'],
            // ... more rows
        ]);
    }

    public function headings(): array
    {
        return [
            'Visit Date',
            'Patient Name',
            'Complaint',
            'Diagnosis',
            'Medications',
            'Status',
        ];
    }
}
