@extends('layouts.app')

@section('content')
<div class="content">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Medical Visit Details</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if($visit)
                            <div class="patient-details mb-4">
                                <h3>Patient Information</h3>
                                <p><strong>Name:</strong> {{ $visit->patient->first_name }} {{ $visit->patient->middle_name}} {{ $visit->patient->last_name}}</p>
                                <p><strong>ID:</strong> {{ $visit->patient->unique_id }}</p>
                                <p><strong>Gender:</strong> {{ $visit->patient->gender }}</p>
                                <p><strong>Age:</strong> {{ $visit->patient->age }}</p>
                            </div>

                            <div class="visit-details mb-4">
                                <h3>Visit Details</h3>
                                <p><strong>Visit Date:</strong> {{ $visit->visit_date }}</p>
                                <p><strong>Doctor:</strong> {{ $visit->doctor_name }}</p>
                                <p><strong>Nurse:</strong> {{ $visit->nurse_name }}</p>
                                <p><strong>Diagnosis:</strong> {{ $visit->diagnosis }}</p>
                                <p><strong>Simplified Diagnosis:</strong> {{ $visit->simplified_diagnosis }}</p>
                            </div>

                            <div class="treatment-details mb-4">
                                <h3>Treatment Information</h3>
                                <p><strong>Vitals:</strong></p>
                                <ul>
                                    <li>Blood Pressure: {{ $visit->blood_pressure }}</li>
                                    <li>Heart Rate: {{ $visit->heart_rate }}</li>
                                    <li>Temperature: {{ $visit->temperature }}</li>
                                    <li>Weight: {{ $visit->weight }}</li>
                                </ul>
                                <p><strong>Ongoing Treatments:</strong> {{ $visit->ongoing_treatments }}</p>
                                <p><strong>Medications Prescribed:</strong> {{ $visit->medications_prescribed }}</p>
                                <p><strong>Procedures Performed:</strong> {{ $visit->procedures }}</p>
                            </div>

                            <div class="notes mb-4">
                                <h3>Additional Notes</h3>
                                <p><strong>Doctor's Notes:</strong> {{ $visit->doctor_notes }}</p>
                                <p><strong>Nurse's Observations:</strong> {{ $visit->nurse_observations }}</p>
                            </div>

                            <a href="{{ route('medical_visit.edit', $visit->id) }}" class="btn btn-primary">Update Visit</a>

                            @else
                            <p>No visit details available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection