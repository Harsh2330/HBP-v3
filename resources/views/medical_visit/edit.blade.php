@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4 text-primary font-weight-bold" style="font-size: 2.5rem;">Edit Medical Visit</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg transition-card">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li style="font-size: 1.1rem;">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('medical_visit.update', $visit->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="patient-details mb-4">
                            <h3 class="text-primary font-weight-bold" style="font-size: 1.8rem;">Patient Information</h3>
                            <div class="form-group">
                                <label for="patient_id" style="font-size: 1.1rem;">Patient</label>
                                <select name="patient_id" id="patient_id" class="form-control" disabled style="font-size: 1.1rem;">
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}" data-unique-id="{{ $patient->unique_id }}" @if($patient->id == $visit->patient_id) selected @endif>{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="unique_id" id="unique_id" value="{{ $visit->unique_id }}">
                        </div>

                        <div class="visit-details mb-4">
                            <h3 class="text-primary font-weight-bold" style="font-size: 1.8rem;">Visit Details</h3>
                            <div class="form-group">
                                <label for="visit_date" style="font-size: 1.1rem;">Visit Date</label>
                                <input type="text" name="visit_date" id="visit_date" class="form-control datetimepicker" value="{{ $visit->visit_date }}" style="font-size: 1.1rem;">
                            </div>
                            <div class="form-group">
                                <label for="doctor_name" style="font-size: 1.1rem;">Doctor</label>
                                <input type="text" name="doctor_name" id="doctor_name" class="form-control" value="{{ $visit->doctor_name }}" style="font-size: 1.1rem;">
                            </div>
                            <div class="form-group">
                                <label for="nurse_name" style="font-size: 1.1rem;">Nurse</label>
                                <input type="text" name="nurse_name" id="nurse_name" class="form-control" value="{{ $visit->nurse_name }}" style="font-size: 1.1rem;">
                            </div>
                        </div>

                        <div class="treatment-details mb-4">
                            <h3 class="text-primary font-weight-bold" style="font-size: 1.8rem;">Treatment Information</h3>
                            <div class="form-group">
                                <label for="diagnosis" style="font-size: 1.1rem;">Diagnosis</label>
                                <textarea name="diagnosis" id="diagnosis" class="form-control" rows="3" style="font-size: 1.1rem;">{{ $visit->diagnosis }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="simplified_diagnosis" style="font-size: 1.1rem;">Simplified Diagnosis</label>
                                <textarea name="simplified_diagnosis" id="simplified_diagnosis" class="form-control" rows="3" style="font-size: 1.1rem;">{{ $visit->simplified_diagnosis }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="blood_pressure" style="font-size: 1.1rem;">Blood Pressure</label>
                                <input type="text" name="blood_pressure" id="blood_pressure" class="form-control" value="{{ $visit->blood_pressure }}" style="font-size: 1.1rem;">
                            </div>
                            <div class="form-group">
                                <label for="heart_rate" style="font-size: 1.1rem;">Heart Rate</label>
                                <input type="text" name="heart_rate" id="heart_rate" class="form-control" value="{{ $visit->heart_rate }}" style="font-size: 1.1rem;">
                            </div>
                            <div class="form-group">
                                <label for="temperature" style="font-size: 1.1rem;">Temperature</label>
                                <input type="text" name="temperature" id="temperature" class="form-control" value="{{ $visit->temperature }}" style="font-size: 1.1rem;">
                            </div>
                            <div class="form-group">
                                <label for="weight" style="font-size: 1.1rem;">Weight</label>
                                <input type="text" name="weight" id="weight" class="form-control" value="{{ $visit->weight }}" style="font-size: 1.1rem;">
                            </div>
                            <div class="form-group">
                                <label for="ongoing_treatments" style="font-size: 1.1rem;">Ongoing Treatments</label>
                                <textarea name="ongoing_treatments" id="ongoing_treatments" class="form-control" rows="3" style="font-size: 1.1rem;">{{ $visit->ongoing_treatments }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="medications_prescribed" style="font-size: 1.1rem;">Medications Prescribed</label>
                                <textarea name="medications_prescribed" id="medications_prescribed" class="form-control" rows="3" style="font-size: 1.1rem;">{{ $visit->medications_prescribed }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="procedures" style="font-size: 1.1rem;">Procedures Performed</label>
                                <textarea name="procedures" id="procedures" class="form-control" rows="3" style="font-size: 1.1rem;">{{ $visit->procedures }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="treatment_name">Treatment Name</label>
                                <input type="text" name="treatment_name" id="treatment_name" class="form-control" value="{{ $visit->treatment_name }}">
                            </div>
                        </div>

                        <div class="notes mb-4">
                            <h3 class="text-primary font-weight-bold" style="font-size: 1.8rem;">Additional Notes</h3>
                            <div class="form-group">
                                <label for="doctor_notes" style="font-size: 1.1rem;">Doctor's Notes</label>
                                <textarea name="doctor_notes" id="doctor_notes" class="form-control" rows="3" style="font-size: 1.1rem;">{{ $visit->doctor_notes }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="nurse_observations" style="font-size: 1.1rem;">Nurse's Observations</label>
                                <textarea name="nurse_observations" id="nurse_observations" class="form-control" rows="3" style="font-size: 1.1rem;">{{ $visit->nurse_observations }}</textarea>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('medical_visit.index') }}" class="btn btn-secondary">Back to List</a>
                    </form>
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

<script>
document.getElementById('patient_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var uniqueId = selectedOption.getAttribute('data-unique-id');
    document.getElementById('unique_id').value = uniqueId;
});

document.addEventListener('DOMContentLoaded', function() {
    flatpickr('.datetimepicker', {
        enableTime: true,
        dateFormat: 'Y-m-d H:i'
    });
});
</script>
@endsection
