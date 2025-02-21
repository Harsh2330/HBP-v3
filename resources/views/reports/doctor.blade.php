@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4 text-primary font-weight-bold">Detailed Medical Visit Report</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg transition-card">
                <div class="card-body">
                    @foreach($doctorVisits as $visit)
                    <h3 class="text-primary font-weight-bold">Patient Information</h3>
                    <p>Patient Name: {{ $visit->patient->full_name }}</p>
                    <p>Patient ID: {{ $visit->patient->pat_unique_id }}</p>
                    <p>Gender: {{ $visit->patient->gender }}</p>
                    <p>Age Category: {{ $visit->patient->age_category }}</p>
                    <p>Contact Number: {{ $visit->patient->phone_number }}</p>
                    <p>Emergency Contact: {{ $visit->patient->emergency_contact_name }}, {{ $visit->patient->emergency_contact_relationship }}, {{ $visit->patient->emergency_contact_phone }}</p>

                    <h3 class="text-primary font-weight-bold">Visit Details</h3>
                    <p>Visit Date: {{ $visit->visit_date }}</p>
                    <p>Appointment Type: {{ $visit->appointment_type }}</p>
                    <p>Primary Complaint: {{ $visit->primary_complaint }}</p>
                    <p>Symptoms: {{ $visit->symptoms }}</p>
                    <p>Doctor Assigned: {{ $visit->doctor->name }}</p>
                    <p>Nurse Assigned: {{ $visit->nurse->name }}</p>
                    <p>Medical Status: {{ $visit->medical_status }}</p>

                    <h3 class="text-primary font-weight-bold">Medical Diagnosis & Vitals</h3>
                    <p>Diagnosis: {{ $visit->diagnosis }}</p>
                    <p>Simplified Diagnosis: {{ $visit->simplified_diagnosis }}</p>
                    <p>Sugar Level: {{ $visit->sugar_level }}</p>
                    <p>Heart Rate: {{ $visit->heart_rate }}</p>
                    <p>Temperature: {{ $visit->temperature }}</p>
                    <p>Oxygen Level: {{ $visit->oxygen_level }}</p>

                    <h3 class="text-primary font-weight-bold">Treatment Plan</h3>
                    <p>Medications Prescribed: {{ $visit->medications_prescribed }}</p>
                    <p>Ongoing Treatments: {{ $visit->ongoing_treatments }}</p>
                    <p>Procedures Done: {{ $visit->procedures }}</p>
                    <p>Doctor’s Notes: {{ $visit->doctor_notes }}</p>
                    <p>Nurse Observations: {{ $visit->nurse_observations }}</p>

                    <h3 class="text-primary font-weight-bold">Follow-up Details</h3>
                    <p>Next Preferred Visit Date: {{ $visit->preferred_visit_date }}</p>
                    <p>Preferred Time Slot: {{ $visit->preferred_time_slot }}</p>
                    <p>Is Emergency?: {{ $visit->is_emergency ? 'Yes' : 'No' }}</p>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
