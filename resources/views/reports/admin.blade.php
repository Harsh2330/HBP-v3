@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4 text-primary font-weight-bold">Hospital Activity Report</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg transition-card">
                <div class="card-body">
                    <h3 class="text-primary font-weight-bold">Summary Statistics</h3>
                    <p>Total Patients Registered: {{ $totalPatients }}</p>
                    <p>Total Visits This Month: {{ $totalVisits }}</p>
                    <p>Approved Visits: {{ $approvedVisits }}</p>
                    <p>Pending Visits: {{ $pendingVisits }}</p>
                    <p>Emergency Cases: {{ $emergencyCases }}</p>

                    <h3 class="text-primary font-weight-bold">Appointments Overview</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Visit Date</th>
                                <th>Doctor Assigned</th>
                                <th>Appointment Type</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->patient->full_name }}</td>
                                <td>{{ $appointment->visit_date }}</td>
                                <td>{{ $appointment->doctor->name }}</td>
                                <td>{{ $appointment->appointment_type }}</td>
                                <td>{{ $appointment->is_approved }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="text-primary font-weight-bold">Doctor Performance Summary</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Doctor Name</th>
                                <th>Patients Seen</th>
                                <th>Pending Approvals</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($doctorPerformance as $doctor)
                            <tr>
                                <td>{{ $doctor->name }}</td>
                                <td>{{ $doctor->medical_visits_count }}</td>
                                <td>{{ $doctor->pending_approvals_count }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="text-primary font-weight-bold">Patient Trends & Statistics</h3>
                    <p>Most Common Diagnoses: [List of Top 5 Diagnoses]</p>
                    <p>Average Age of Patients: [Average Age]</p>
                    <p>Top 5 Medications Prescribed: [List]</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
