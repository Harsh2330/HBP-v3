@extends('layouts.app')

@section('content')
<div class="content">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Medical Visit</h1>
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
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('medical_visit.update', $visit->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="patient-details">
                                    <h3>Patient Information</h3>
                                    <div class="form-group">
                                        <label for="patient_id">Patient</label>
                                        <select name="patient_id" id="patient_id" class="form-control" disabled>
                                            @foreach($patients as $patient)
                                                <option value="{{ $patient->id }}" data-unique-id="{{ $patient->unique_id }}" @if($patient->id == $visit->patient_id) selected @endif>{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" name="unique_id" id="unique_id" value="{{ $visit->unique_id }}">
                                </div>

                                <div class="visit-details">
                                    <h3>Visit Details</h3>
                                    <div class="form-group">
                                        <label for="visit_date">Visit Date</label>
                                        <input type="date" name="visit_date" id="visit_date" class="form-control" value="{{ $visit->visit_date }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="doctor_name">Doctor</label>
                                        <input type="text" name="doctor_name" id="doctor_name" class="form-control" value="{{ $visit->doctor_name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nurse_name">Nurse</label>
                                        <input type="text" name="nurse_name" id="nurse_name" class="form-control" value="{{ $visit->nurse_name }}">
                                    </div>
                                </div>

                                <div class="treatment-details">
                                    <h3>Treatment Information</h3>
                                    <div class="form-group">
                                        <label for="diagnosis">Diagnosis</label>
                                        <textarea name="diagnosis" id="diagnosis" class="form-control" rows="3">{{ $visit->diagnosis }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="simplified_diagnosis">Simplified Diagnosis</label>
                                        <textarea name="simplified_diagnosis" id="simplified_diagnosis" class="form-control" rows="3">{{ $visit->simplified_diagnosis }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="blood_pressure">Blood Pressure</label>
                                        <input type="text" name="blood_pressure" id="blood_pressure" class="form-control" value="{{ $visit->blood_pressure }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="heart_rate">Heart Rate</label>
                                        <input type="text" name="heart_rate" id="heart_rate" class="form-control" value="{{ $visit->heart_rate }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="temperature">Temperature</label>
                                        <input type="text" name="temperature" id="temperature" class="form-control" value="{{ $visit->temperature }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="weight">Weight</label>
                                        <input type="text" name="weight" id="weight" class="form-control" value="{{ $visit->weight }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="ongoing_treatments">Ongoing Treatments</label>
                                        <textarea name="ongoing_treatments" id="ongoing_treatments" class="form-control" rows="3">{{ $visit->ongoing_treatments }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="medications_prescribed">Medications Prescribed</label>
                                        <textarea name="medications_prescribed" id="medications_prescribed" class="form-control" rows="3">{{ $visit->medications_prescribed }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="procedures">Procedures Performed</label>
                                        <textarea name="procedures" id="procedures" class="form-control" rows="3">{{ $visit->procedures }}</textarea>
                                    </div>
                                </div>

                                <div class="notes">
                                    <h3>Additional Notes</h3>
                                    <div class="form-group">
                                        <label for="doctor_notes">Doctor's Notes</label>
                                        <textarea name="doctor_notes" id="doctor_notes" class="form-control" rows="3">{{ $visit->doctor_notes }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="nurse_observations">Nurse's Observations</label>
                                        <textarea name="nurse_observations" id="nurse_observations" class="form-control" rows="3">{{ $visit->nurse_observations }}</textarea>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
document.getElementById('patient_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var uniqueId = selectedOption.getAttribute('data-unique-id');
    document.getElementById('unique_id').value = uniqueId;
});
</script>
@endsection
