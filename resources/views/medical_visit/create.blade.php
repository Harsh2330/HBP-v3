@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4 text-primary font-weight-bold">Create Medical Visit</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg transition-card">
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
                    <form action="{{ route('medical_visit.store') }}" method="POST">
                        @csrf
                        <div class="patient-details mb-4">
                            <h3 class="text-primary font-weight-bold">Patient Information</h3>
                            @php
                                $patients = \App\Models\Patient::where('user_unique_id', auth()->user()->id)->get();
                            @endphp
                            <div class="form-group">
                                <label for="patient_id">Patient</label>
                                <select name="patient_id" id="patient_id" class="form-control custom-select">
                                    @foreach($patients as $patient)
                                        <option value="{{ $patient->id }}" data-unique-id="{{ $patient->unique_id }}">{{ $patient->full_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="unique_id" id="unique_id" value="">
                        </div>

                        <div class="visit-details mb-4">
                            <h3 class="text-primary font-weight-bold">Visit Details</h3>
                            <div class="form-group">
                                <label for="visit_date">Visit Date</label>
                                <input type="date" name="visit_date" id="visit_date" class="form-control" value="{{ old('visit_date') }}">
                            </div>
                            <div class="form-group">
                                <label for="doctor_id">Doctor</label>
                                <select name="doctor_id" id="doctor_id" class="form-control" required>
                                    <!-- Options will be populated by JavaScript -->
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nurse_id">Nurse</label>
                                <select name="nurse_id" id="nurse_id" class="form-control" required>
                                    <!-- Options will be populated by JavaScript -->
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
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
    .hover-effect:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }
</style>

<script>
document.getElementById('patient_id').addEventListener('change', function() {
    var selectedOption = this.options[this.selectedIndex];
    var uniqueId = selectedOption.getAttribute('data-unique-id');
    document.getElementById('unique_id').value = uniqueId;
});

document.addEventListener('DOMContentLoaded', function() {
    fetchUsersWithRole('doctor', 'doctor_id');
    fetchUsersWithRole('nurse', 'nurse_id');

    function fetchUsersWithRole(role, id) {
        fetch(`/api/users-with-role/${role}`)
            .then(response => response.json())
            .then(data => {
                const userSelect = document.getElementById(id);
                userSelect.innerHTML = '';
                data.forEach(user => {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.textContent = user.name;
                    userSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Error fetching users with role:', error));
    }
});
</script>
@endsection
