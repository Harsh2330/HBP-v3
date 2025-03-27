@extends('layouts.pdf')

@section('content')
<div style="padding: 1.5rem; background-color: #f7fafc;">
    <h1 style="text-align: center; margin-bottom: 1rem; color: #1d4ed8; font-weight: bold; font-size: 1.5rem;">Personal Medical Summary</h1>

    <h3 style="color: #1d4ed8; font-weight: bold; font-size: 1.25rem; margin-bottom: 1rem;">Patient Profile</h3>
    <div style="margin-bottom: 1rem; padding: 1rem; background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); border-radius: 0.25rem;">
        <p><span style="font-weight: 600; color: #3b82f6;">Name:</span> {{ $patient->full_name }}</p>
        <p><span style="font-weight: 600; color: #3b82f6;">Patient ID:</span> {{ $patient->pat_unique_id }}</p>
        <p><span style="font-weight: 600; color: #3b82f6;">Gender:</span> {{ $patient->gender }}</p>
        <p><span style="font-weight: 600; color: #3b82f6;">Date of Birth:</span> {{ $patient->date_of_birth }}</p>
        <p><span style="font-weight: 600; color: #3b82f6;">Contact Number:</span> {{ $patient->phone_number }}</p>
        <p><span style="font-weight: 600; color: #3b82f6;">Email:</span> {{ $patient->email ?? 'N/A' }}</p>
        <p><span style="font-weight: 600; color: #3b82f6;">Emergency Contact:</span> {{ $patient->emergency_contact_name ?? 'N/A' }} – {{ $patient->emergency_contact_relationship ?? 'N/A' }} ({{ $patient->emergency_contact_phone ?? 'N/A' }})</p>
    </div>

    <h3 style="color: #1d4ed8; font-weight: bold; font-size: 1.25rem; margin-top: 1.5rem;">Recent Medical Visits</h3>
    <table style="min-width: 100%; background-color: #ffffff; border: 1px solid #e5e7eb; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); border-radius: 0.25rem;">
        <thead style="background-color: #dbeafe;">
            <tr>
                <th style="padding: 0.5rem 1rem; border-bottom: 1px solid #e5e7eb; color: #3b82f6;">Visit Date</th>
                <th style="padding: 0.5rem 1rem; border-bottom: 1px solid #e5e7eb; color: #3b82f6;">Doctor</th>
                <th style="padding: 0.5rem 1rem; border-bottom: 1px solid #e5e7eb; color: #3b82f6;">Complaint</th>
                <th style="padding: 0.5rem 1rem; border-bottom: 1px solid #e5e7eb; color: #3b82f6;">Diagnosis</th>
                <th style="padding: 0.5rem 1rem; border-bottom: 1px solid #e5e7eb; color: #3b82f6;">Medications</th>
                <th style="padding: 0.5rem 1rem; border-bottom: 1px solid #e5e7eb; color: #3b82f6;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($userVisits as $visit)
            <tr style="hover:bg-gray-100;">
                <td style="padding: 0.5rem 1rem; border-bottom: 1px solid #e5e7eb;">{{ $visit->visit_date }}</td>
                <td style="padding: 0.5rem 1rem; border-bottom: 1px solid #e5e7eb;">{{ $visit->doctor->name ?? 'N/A' }}</td>
                <td style="padding: 0.5rem 1rem; border-bottom: 1px solid #e5e7eb;">{{ $visit->primary_complaint ?? 'N/A' }}</td>
                <td style="padding: 0.5rem 1rem; border-bottom: 1px solid #e5e7eb;">{{ $visit->diagnosis ?? 'N/A' }}</td>
                <td style="padding: 0.5rem 1rem; border-bottom: 1px solid #e5e7eb;">{{ $visit->medications_prescribed ?? 'N/A' }}</td>
                <td style="padding: 0.5rem 1rem; border-bottom: 1px solid #e5e7eb;">{{ $visit->is_approved ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3 style="color: #1d4ed8; font-weight: bold; font-size: 1.25rem; margin-top: 1.5rem;">Health Vitals Summary</h3>
    <div style="margin-bottom: 1rem; padding: 1rem; background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); border-radius: 0.25rem;">
        <p><span style="font-weight: 600; color: #3b82f6;">Latest Heart Rate:</span> {{ $userVisits->last()->heart_rate ?? 'N/A' }}</p>
        <p><span style="font-weight: 600; color: #3b82f6;">Latest Sugar Level:</span> {{ $userVisits->last()->sugar_level ?? 'N/A' }}</p>
        <p><span style="font-weight: 600; color: #3b82f6;">Latest Temperature:</span> {{ $userVisits->last()->temperature ?? 'N/A' }}</p>
        <p><span style="font-weight: 600; color: #3b82f6;">Oxygen Level:</span> {{ $userVisits->last()->oxygen_level ?? 'N/A' }}</p>
    </div>

    <h3 style="color: #1d4ed8; font-weight: bold; font-size: 1.25rem; margin-top: 1.5rem;">Current Treatment Plan</h3>
    <div style="margin-bottom: 1rem; padding: 1rem; background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); border-radius: 0.25rem;">
        <p><span style="font-weight: 600; color: #3b82f6;">Medications:</span> {{ $userVisits->last()->medications_prescribed ?? 'N/A' }}</p>
        <p><span style="font-weight: 600; color: #3b82f6;">Ongoing Treatments:</span> {{ $userVisits->last()->ongoing_treatments ?? 'N/A' }}</p>
        <p><span style="font-weight: 600; color: #3b82f6;">Procedures Done:</span> {{ $userVisits->last()->procedures ?? 'N/A' }}</p>
        <p><span style="font-weight: 600; color: #3b82f6;">Doctor’s Recommendations:</span> {{ $userVisits->last()->doctor_notes ?? 'N/A' }}</p>
    </div>

    <h3 style="color: #1d4ed8; font-weight: bold; font-size: 1.25rem; margin-top: 1.5rem;">Next Steps & Follow-up</h3>
    <div style="margin-bottom: 1rem; padding: 1rem; background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); border-radius: 0.25rem;">
        <p><span style="font-weight: 600; color: #3b82f6;">Next Visit Date:</span> {{ $userVisits->last()->preferred_visit_date ?? 'N/A' }}</p>
        <p><span style="font-weight: 600; color: #3b82f6;">Preferred Time Slot:</span> {{ $userVisits->last()->preferred_time_slot ?? 'N/A' }}</p>
        <p><span style="font-weight: 600; color: #3b82f6;">Is Emergency Case?:</span> {{ $userVisits->last()->is_emergency ? 'Yes' : 'No' }}</p>
        <p><span style="font-weight: 600; color: #3b82f6;">Emergency Contact for Queries:</span> {{ $patient->emergency_contact_name ?? 'N/A' }}, {{ $patient->emergency_contact_phone ?? 'N/A' }}</p>
    </div>

    <h3 style="color: #1d4ed8; font-weight: bold; font-size: 1.25rem; margin-top: 1.5rem;">Report Summary for Period</h3>
    <div style="margin-bottom: 1rem; padding: 1rem; background-color: #ffffff; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); border-radius: 0.25rem;">
        <p><span style="font-weight: 600; color: #3b82f6;">Total Visits:</span> {{ $userVisits->count() }}</p>
        <p><span style="font-weight: 600; color: #3b82f6;">New Diagnoses:</span> {{ $userVisits->pluck('diagnosis')->unique()->implode(', ') ?? 'N/A' }}</p>
        <p><span style="font-weight: 600; color: #3b82f6;">Medications Prescribed:</span> {{ $userVisits->pluck('medications_prescribed')->unique()->implode(', ') ?? 'N/A' }}</p>
    </div>
</div>
@endsection
