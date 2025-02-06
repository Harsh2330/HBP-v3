@extends('layouts.app')

@section('content')
<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Patient</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Patient Information</h3>
                        </div>
                        <div class="card-body">
                            @if(session('approved_session'))
                                @php
                                    $approvedSession = session('approved_session');
                                    $user = \App\Models\User::find($approvedSession['user_id']);
                                @endphp
                                @if($user)
                                    <div style="background-color: #d4edda; padding: 10px; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 15px;">
                                        Approved Patient: {{ $user->first_name }} (Unique ID: {{ $approvedSession['unique_id'] }}) Approved At: {{ $approvedSession['approved_at'] }}
                                    </div>
                                @endif
                            @endif
                            <form id="patientForm" action="{{ route('admin.patient.storePatientData', $patient->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="text" name="date_of_birth" class="form-control" value="{{ $patient->date_of_birth }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="age_category">Age Category</label>
                                    <select name="age_category" class="form-control" required>
                                        <option value="Child" {{ $patient->age_category == 'Child' ? 'selected' : '' }}>Child</option>
                                        <option value="Adult" {{ $patient->age_category == 'Adult' ? 'selected' : '' }}>Adult</option>
                                        <option value="Senior" {{ $patient->age_category == 'Senior' ? 'selected' : '' }}>Senior</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control" value="{{ $patient->phone_number }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ $patient->email }}">
                                </div>
                                <div class="form-group">
                                    <label for="full_address">Full Address</label>
                                    <textarea name="full_address" class="form-control" required>{{ $patient->full_address }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="religion">Religion</label>
                                    <input type="text" name="religion" class="form-control" value="{{ $patient->religion }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="economic_status">Economic Status</label>
                                    <select name="economic_status" class="form-control" required>
                                        <option value="Poor" {{ $patient->economic_status == 'Poor' ? 'selected' : '' }}>Poor</option>
                                        <option value="Lower Middle" {{ $patient->economic_status == 'Lower Middle' ? 'selected' : '' }}>Lower Middle</option>
                                        <!-- Add other economic statuses as needed -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bpl_card_number">BPL Card Number</label>
                                    <input type="text" name="bpl_card_number" class="form-control" value="{{ $patient->bpl_card_number }}">
                                </div>
                                <div class="form-group">
                                    <label for="ayushman_card">Ayushman Card</label>
                                    <select name="ayushman_card" class="form-control" required>
                                        <option value="1" {{ $patient->ayushman_card ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ !$patient->ayushman_card ? 'selected' : '' }}>No</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="emergency_contact_name">Emergency Contact Name</label>
                                    <input type="text" name="emergency_contact_name" class="form-control" value="{{ $patient->emergency_contact_name }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="emergency_contact_phone">Emergency Contact Phone</label>
                                    <input type="text" name="emergency_contact_phone" class="form-control" value="{{ $patient->emergency_contact_phone }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="emergency_contact_relationship">Emergency Contact Relationship</label>
                                    <select name="emergency_contact_relationship" class="form-control" required>
                                        <option value="Son" {{ $patient->emergency_contact_relationship == 'Son' ? 'selected' : '' }}>Son</option>
                                        <option value="Daughter" {{ $patient->emergency_contact_relationship == 'Daughter' ? 'selected' : '' }}>Daughter</option>
                                        <!-- Add other relationships as needed -->
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr('input[name="date_of_birth"]', {
            dateFormat: 'Y-m-d'
        });
    });
</script>
@endsection