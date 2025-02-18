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
                                <p><strong>Time Slot:</strong> {{ $visit->time_slot }}</p>
                                <p><strong>Preferred Visit Date:</strong> {{ $visit->preferred_visit_date }}</p>
                                <p><strong>Preferred Time Slot:</strong> {{ $visit->preferred_time_slot }}</p>
                                <p><strong>Doctor:</strong> {{ $visit->doctor_name }}</p>
                                <p><strong>Nurse:</strong> {{ $visit->nurse_name }}</p>
                                <p><strong>Appointment Type:</strong> {{ $visit->appointment_type }}</p>
                                <p><strong>Primary Complaint:</strong> {{ $visit->primary_complaint }}</p>
                                <p><strong>Symptoms:</strong> {{ $visit->symptoms }}</p>
                                <p><strong>Emergency:</strong> {{ $visit->is_emergency ? 'Yes' : 'No' }}</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="treatment-info" role="tabpanel" aria-labelledby="treatment-info-tab">
                            <div class="treatment-details mt-4">
                                <h3 class="text-primary font-weight-bold"><i class="fas fa-stethoscope"></i> Treatment Information</h3>
                                <p><strong>Vitals:</strong></p>
                                <ul>
                                    <li>Sugar Level: {{ $visit->sugar_level }}</li>
                                    <li>Heart Rate: {{ $visit->heart_rate }}</li>
                                    <li>Temperature: {{ $visit->temperature }}</li>
                                    <li>Oxygen Level: {{ $visit->oxygen_level }}</li>
                                </ul>
                                <p><strong>Simplified Diagnosis:</strong> {{ $visit->simplified_diagnosis }}</p>
                                <p><strong>Diagnosis:</strong> {{ $visit->diagnosis }}</p>
                                <p><strong>Prescribed Medications:</strong> {{ $visit->medications_prescribed }}</p>
                                <p><strong>Treatment Plan:</strong> {{ $visit->ongoing_treatments }}</p>
                                <p><strong>Next Steps:</strong> {{ $visit->procedures }}</p>
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

                    @can('medical-visit-edit', $visit)
                    <a href="{{ route('medical_visit.edit', $visit->id) }}" class="btn btn-primary mt-4">Update Visit</a>
                    @endcan

                    @can('medical-visit-reschedule', $visit)
                    <button class="btn btn-warning mt-4" data-toggle="modal" data-target="#rescheduleModal-{{ $visit->id }}">Reschedule Visit</button>
                    @endcan

                    <a href="{{ route('medical_visit.index') }}" class="btn btn-secondary mt-4">Back to List</a>

                    <div class="modal fade" id="rescheduleModal-{{ $visit->id }}" tabindex="-1" role="dialog" aria-labelledby="rescheduleModalLabel-{{ $visit->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="rescheduleModalLabel-{{ $visit->id }}">Reschedule Medical Visit</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('medical_visit.reschedule', $visit->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="form-group">
                                            <label for="visit_date">Visit Date</label>
                                            <input type="date" name="visit_date" id="visit_date" class="form-control" value="{{ $visit->visit_date }}" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="time_slot">Time Slot</label>
                                            <input type="time" name="time_slot" id="time_slot" class="form-control" value="{{ $visit->time_slot }}" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Reschedule</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            // Handle reschedule modal
                            var rescheduleButtons = document.querySelectorAll('[data-toggle="modal"]');
                            rescheduleButtons.forEach(function (button) {
                                button.addEventListener('click', function () {
                                    var target = button.getAttribute('data-target');
                                    var modal = document.querySelector(target);
                                    $(modal).modal('show');
                                });
                            });
                        });
                    </script>

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
    .modal {
        display: none;
        position: fixed;
        z-index: 1050; /* Ensure the modal is on top */
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 500px;
        z-index: 1051; /* Ensure the modal content is on top */
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
@endsection