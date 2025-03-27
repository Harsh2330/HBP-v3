@extends('layouts.pdf')

@section('content')
<h1 style="text-align: center; margin-bottom: 20px; color: #1E3A8A; font-weight: bold; font-size: 24px;">Hospital Activity Report</h1>

<h3 style="color: #1E3A8A; font-weight: bold; font-size: 20px; margin-bottom: 20px;">Summary Statistics</h3>
<p>Total Patients Registered: <span style="font-weight: bold;">{{ $totalPatients ?? 'N/A' }}</span></p>
<p>Total Visits This Month: <span style="font-weight: bold;">{{ $totalVisits ?? 'N/A' }}</span></p>
<p>Approved Visits: <span style="font-weight: bold;">{{ $approvedVisits ?? 'N/A' }}</span></p>
<p>Pending Visits: <span style="font-weight: bold;">{{ $pendingVisits ?? 'N/A' }}</span></p>
<p>Emergency Visits: <span style="font-weight: bold;">{{ $emergencyCases ?? 'N/A' }}</span></p>

<h3 style="color: #1E3A8A; font-weight: bold; font-size: 20px; margin-top: 30px;">Doctor-wise Visit Breakdown</h3>
<table style="width: 100%; background-color: #FFFFFF; border: 1px solid #E5E7EB;">
    <thead>
        <tr>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Doctor Name</th>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Patients Seen</th>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Pending Visits</th>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Completed Visits</th>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Emergency Visits</th>
        </tr>
    </thead>
    <tbody>
        @foreach($doctorPerformance as $doctor)
        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $doctor->name ?? 'N/A' }}</td>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $doctor->patients_seen ?? 'N/A' }}</td>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $doctor->pending_visits ?? 'N/A' }}</td>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $doctor->completed_visits ?? 'N/A' }}</td>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $doctor->emergency_visits ?? 'N/A' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3 style="color: #1E3A8A; font-weight: bold; font-size: 20px; margin-top: 30px;">Patient Demographics</h3>
<p>Male Patients: <span style="font-weight: bold;">{{ $malePatients ?? 'N/A' }}</span></p>
<p>Female Patients: <span style="font-weight: bold;">{{ $femalePatients ?? 'N/A' }}</span></p>
<p>Other Gender: <span style="font-weight: bold;">{{ $otherGenderPatients ?? 'N/A' }}</span></p>
<p>Age Distribution:</p>
<ul style="list-style-type: disc; padding-left: 20px;">
    <li>Children (0-12): <span style="font-weight: bold;">{{ $childrenCount ?? 'N/A' }}</span></li>
    <li>Teenagers (13-19): <span style="font-weight: bold;">{{ $teenagersCount ?? 'N/A' }}</span></li>
    <li>Adults (20-59): <span style="font-weight: bold;">{{ $adultsCount ?? 'N/A' }}</span></li>
    <li>Seniors (60+): <span style="font-weight: bold;">{{ $seniorsCount ?? 'N/A' }}</span></li>
</ul>

<h3 style="color: #1E3A8A; font-weight: bold; font-size: 20px; margin-top: 30px;">Common Diagnoses & Treatments</h3>
<p>Top 5 Most Diagnosed Conditions:</p>
<ul style="list-style-type: disc; padding-left: 20px;">
    @foreach($topDiagnoses as $diagnosis)
    <li>{{ $diagnosis->name }}</li>
    @endforeach
</ul>
<p>Top 5 Most Prescribed Medications:</p>
<ul style="list-style-type: disc; padding-left: 20px;">
    @foreach($topMedications as $medication)
    <li>{{ $medication->name }}</li>
    @endforeach
</ul>
<p>Common Procedures Done:</p>
<ul style="list-style-type: disc; padding-left: 20px;">
    @foreach($commonProcedures as $procedure)
    <li>{{ $procedure->name }}</li>
    @endforeach
</ul>

<h3 style="color: #1E3A8A; font-weight: bold; font-size: 20px; margin-top: 30px;">Appointment Summary</h3>
<table style="width: 100%; background-color: #FFFFFF; border: 1px solid #E5E7EB;">
    <thead>
        <tr>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Visit Date</th>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Patient Name</th>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Doctor Assigned</th>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Appointment Type</th>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($appointments as $appointment)
        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $appointment->visit_date ?? 'N/A' }}</td>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $appointment->patient->full_name ?? 'N/A' }}</td>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $appointment->doctor->name ?? 'N/A' }}</td>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $appointment->appointment_type ?? 'N/A' }}</td>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $appointment->is_approved ?? 'N/A' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
