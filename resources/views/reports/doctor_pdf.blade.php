@extends('layouts.pdf')

@section('content')
<h1 style="text-align: center; margin-bottom: 20px; color: #1E3A8A; font-weight: bold; font-size: 24px;">Detailed Medical Visit Report</h1>

<h3 style="color: #1E3A8A; font-weight: bold; font-size: 20px; margin-bottom: 20px;">Doctor Information</h3>
<p>Doctor Name: <span style="font-weight: bold;">{{ $doctor->name ?? 'N/A' }}</span></p>
<p>Doctor ID: <span style="font-weight: bold;">{{ $doctor->id ?? 'N/A' }}</span></p>
<p>Specialization: <span style="font-weight: bold;">{{ $doctor->specialty ?? 'N/A' }}</span></p>

<h3 style="color: #1E3A8A; font-weight: bold; font-size: 20px; margin-top: 30px;">Summary Statistics</h3>
<p>Total Patients Seen: <span style="font-weight: bold;">{{ $summary->total_patients ?? 'N/A' }}</span></p>
<p>Emergency Cases Handled: <span style="font-weight: bold;">{{ $summary->emergency_cases ?? 'N/A' }}</span></p>
<p>Pending Visit Approvals: <span style="font-weight: bold;">{{ $summary->pending_approvals ?? 'N/A' }}</span></p>
<p>Completed Visits: <span style="font-weight: bold;">{{ $summary->completed_visits ?? 'N/A' }}</span></p>

<h3 style="color: #1E3A8A; font-weight: bold; font-size: 20px; margin-top: 30px;">Patient Visit Details</h3>
<table style="width: 100%; background-color: #FFFFFF; border: 1px solid #E5E7EB;">
    <thead>
        <tr>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Visit Date</th>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Patient Name</th>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Age</th>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Gender</th>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Complaint</th>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Diagnosis</th>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Medications</th>
            <th style="padding: 10px; border-bottom: 1px solid #E5E7EB;">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($doctorVisits as $visit)
        <tr>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $visit->visit_date ?? 'N/A' }}</td>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $visit->patient->full_name ?? 'N/A' }}</td>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $visit->patient->age_category ?? 'N/A' }}</td>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $visit->patient->gender ?? 'N/A' }}</td>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $visit->primary_complaint ?? 'N/A' }}</td>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $visit->diagnosis ?? 'N/A' }}</td>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $visit->medications_prescribed ?? 'N/A' }}</td>
            <td style="padding: 10px; border-bottom: 1px solid #E5E7EB;">{{ $visit->medical_status ?? 'N/A' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3 style="color: #1E3A8A; font-weight: bold; font-size: 20px; margin-top: 30px;">Vital Stats Summary</h3>
<p>Average Heart Rate: <span style="font-weight: bold;">{{ $vitalStats->avg_heart_rate ?? 'N/A' }}</span></p>
<p>Average Sugar Level: <span style="font-weight: bold;">{{ $vitalStats->avg_sugar_level ?? 'N/A' }}</span></p>
<p>Average Temperature: <span style="font-weight: bold;">{{ $vitalStats->avg_temperature ?? 'N/A' }}</span></p>
<p>Average Oxygen Level: <span style="font-weight: bold;">{{ $vitalStats->avg_oxygen_level ?? 'N/A' }}</span></p>

<h3 style="color: #1E3A8A; font-weight: bold; font-size: 20px; margin-top: 30px;">Treatments & Procedures Done</h3>
<p>Common Diagnoses Treated: <span style="font-weight: bold;">{{ $treatments->common_diagnoses ?? 'N/A' }}</span></p>
<p>Most Prescribed Medications: <span style="font-weight: bold;">{{ $treatments->most_prescribed_medications ?? 'N/A' }}</span></p>
<p>Procedures Performed: <span style="font-weight: bold;">{{ $treatments->procedures_performed ?? 'N/A' }}</span></p>

<h3 style="color: #1E3A8A; font-weight: bold; font-size: 20px; margin-top: 30px;">Pending Follow-Ups & Recommendations</h3>
<p>Upcoming Follow-Up Appointments: <span style="font-weight: bold;">{{ $followUps->upcoming_appointments ?? 'N/A' }}</span></p>
<p>Recommendations for Patients: <span style="font-weight: bold;">{{ $followUps->recommendations ?? 'N/A' }}</span></p>
@endsection
