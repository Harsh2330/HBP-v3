@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4 text-primary font-weight-bold">Medical Visit Details</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg transition-card">
                <div class="card-body">
                    @if($visit)
                    <ul class="nav nav-tabs" id="visitDetailsTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="patient-info-tab" data-toggle="tab" href="#patient-info" role="tab" aria-controls="patient-info" aria-selected="true">Patient Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="visit-details-tab" data-toggle="tab" href="#visit-details" role="tab" aria-controls="visit-details" aria-selected="false">Visit Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="treatment-info-tab" data-toggle="tab" href="#treatment-info" role="tab" aria-controls="treatment-info" aria-selected="false">Treatment Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="additional-notes-tab" data-toggle="tab" href="#additional-notes" role="tab" aria-controls="additional-notes" aria-selected="false">Additional Notes</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="visitDetailsTabContent">
                        <div class="tab-pane fade show active" id="patient-info" role="tabpanel" aria-labelledby="patient-info-tab">
                            <div class="patient-details mt-4">
                                <h3 class="text-primary font-weight-bold"><i class="fas fa-user"></i> Patient Information</h3>
                                <p><strong>Name:</strong> {{ $visit->patient->full_name }}</p>
                                <p><strong>ID:</strong> {{ $visit->patient->pat_unique_id }}</p>
                                <p><strong>Gender:</strong> {{ $visit->patient->gender }}</p>
                                <p><strong>Age:</strong> {{ $visit->patient->date_of_birth	 }}</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="visit-details" role="tabpanel" aria-labelledby="visit-details-tab">
                            <div class="visit-details mt-4">
                                <h3 class="text-primary font-weight-bold"><i class="fas fa-calendar-alt"></i> Visit Details</h3>
                                <p><strong>Visit Date:</strong> {{ $visit->visit_date }}</p>
                                <p><strong>Doctor:</strong> {{ $visit->doctor_name }}</p>
                                <p><strong>Nurse:</strong> {{ $visit->nurse_name }}</p>
                                <p><strong>Diagnosis:</strong> {{ $visit->diagnosis }}</p>
                                <p><strong>Simplified Diagnosis:</strong> {{ $visit->simplified_diagnosis }}</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="treatment-info" role="tabpanel" aria-labelledby="treatment-info-tab">
                            <div class="treatment-details mt-4">
                                <h3 class="text-primary font-weight-bold"><i class="fas fa-stethoscope"></i> Treatment Information</h3>
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
                                <p><strong>Treatment Name:</strong> {{ $visit->treatment_name }}</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="additional-notes" role="tabpanel" aria-labelledby="additional-notes-tab">
                            <div class="notes mt-4">
                                <h3 class="text-primary font-weight-bold"><i class="fas fa-notes-medical"></i> Additional Notes</h3>
                                <p><strong>Doctor's Notes:</strong> {{ $visit->doctor_notes }}</p>
                                <p><strong>Nurse's Observations:</strong> {{ $visit->nurse_observations }}</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('medical_visit.edit', $visit->id) }}" class="btn btn-primary mt-4">Update Visit</a>
                    <a href="{{ route('medical_visit.index') }}" class="btn btn-secondary mt-4">Back to List</a>

                    @else
                    <p>No visit details available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .transition-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .transition-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
    .text-primary {
        color: #4e73df !important;
    }
    .font-weight-bold {
        font-weight: bold !important;
    }
</style>
@endsection