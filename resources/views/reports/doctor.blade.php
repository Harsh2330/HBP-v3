@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4 text-primary font-weight-bold">Detailed Medical Visit Report</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg transition-card">
                <div class="card-body">
                    <h3 class="text-primary font-weight-bold">Doctor Information</h3>
                    <p>Doctor Name: {{ $doctor->name ?? 'N/A' }}</p>
                    <p>Doctor ID: {{ $doctor->id ?? 'N/A' }}</p>
                    <p>Specialization: {{ $doctor->specialty ?? 'N/A' }}</p>

                    <a href="{{ route('doctor.report.export', ['doctorId' => $doctor->id]) }}" class="btn btn-secondary bg-green-600 text-white py-2 px-4 rounded-md mb-4">Export to Excel</a>

                    <h3 class="text-primary font-weight-bold">Summary Statistics</h3>
                    <p>Total Patients Seen: {{ $summary->total_patients ?? 'N/A' }}</p>
                    <p>Emergency Cases Handled: {{ $summary->emergency_cases ?? 'N/A' }}</p>
                    <p>Pending Visit Approvals: {{ $summary->pending_approvals ?? 'N/A' }}</p>
                    <p>Completed Visits: {{ $summary->completed_visits ?? 'N/A' }}</p>

                    <h3 class="text-primary font-weight-bold">Patient Visit Details</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Visit Date</th>
                                <th>Patient Name</th>
                                <th>Age</th>
                                <th>Gender</th>
                                <th>Complaint</th>
                                <th>Diagnosis</th>
                                <th>Medications</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($doctorVisits as $visit)
                            <tr>
                                <td>{{ $visit->visit_date ?? 'N/A' }}</td>
                                <td>{{ $visit->patient->full_name ?? 'N/A' }}</td>
                                <td>{{ $visit->patient->age_category ?? 'N/A' }}</td>
                                <td>{{ $visit->patient->gender ?? 'N/A' }}</td>
                                <td>{{ $visit->primary_complaint ?? 'N/A' }}</td>
                                <td>{{ $visit->diagnosis ?? 'N/A' }}</td>
                                <td>{{ $visit->medications_prescribed ?? 'N/A' }}</td>
                                <td>{{ $visit->medical_status ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="text-primary font-weight-bold">Vital Stats Summary</h3>
                    <p>Average Heart Rate: {{ $vitalStats->avg_heart_rate ?? 'N/A' }}</p>
                    <p>Average Sugar Level: {{ $vitalStats->avg_sugar_level ?? 'N/A' }}</p>
                    <p>Average Temperature: {{ $vitalStats->avg_temperature ?? 'N/A' }}</p>
                    <p>Average Oxygen Level: {{ $vitalStats->avg_oxygen_level ?? 'N/A' }}</p>

                    <h3 class="text-primary font-weight-bold">Treatments & Procedures Done</h3>
                    <p>Common Diagnoses Treated: {{ $treatments->common_diagnoses ?? 'N/A' }}</p>
                    <p>Most Prescribed Medications: {{ $treatments->most_prescribed_medications ?? 'N/A' }}</p>
                    <p>Procedures Performed: {{ $treatments->procedures_performed ?? 'N/A' }}</p>

                    <h3 class="text-primary font-weight-bold">Pending Follow-Ups & Recommendations</h3>
                    <p>Upcoming Follow-Up Appointments: {{ $followUps->upcoming_appointments ?? 'N/A' }}</p>
                    <p>Recommendations for Patients: {{ $followUps->recommendations ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
