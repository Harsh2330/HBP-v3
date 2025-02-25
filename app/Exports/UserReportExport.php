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
            'userVisits' => $this->userVisits,
            'patients' => $this->patients,
            'selectedPatientId' => $this->selectedPatientId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate
        ]);
    }
}
