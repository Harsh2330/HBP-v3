@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4 text-primary font-weight-bold">Personal Medical Summary</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg transition-card">
                <div class="card-body">
                    <h3 class="text-primary font-weight-bold">Select Patient</h3>
                    <form method="GET" action="{{ route('reports.user') }}">
                        <div class="form-group">
                            <select name="patient_id" class="form-control" onchange="this.form.submit()" style="font-size: 1.1em;">
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ $selectedPatientId == $patient->id ? 'selected' : '' }}>
                                        {{ $patient->full_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                    @if($selectedPatientId && !empty($userVisits))
                    <h3 class="text-primary font-weight-bold">Patient Profile</h3>
                    <p>Name: {{ $patients->find($selectedPatientId)->full_name }}</p>
                    <p>Patient ID: {{ $patients->find($selectedPatientId)->pat_unique_id }}</p>
                    <p>Gender: {{ $patients->find($selectedPatientId)->gender }}</p>
                    <p>Date of Birth: {{ $patients->find($selectedPatientId)->date_of_birth }}</p>
                    <p>Contact Number: {{ $patients->find($selectedPatientId)->phone_number }}</p>

                    <h3 class="text-primary font-weight-bold">Recent Medical Visits</h3>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Visit Date</th>
                                <th>Doctor</th>
                                <th>Complaint</th>
                                <th>Diagnosis</th>
                                <th>Medications</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($userVisits as $visit)
                            <tr>
                                <td>{{ $visit->visit_date }}</td>
                                <td>{{ $visit->doctor->name }}</td>
                                <td>{{ $visit->primary_complaint }}</td>
                                <td>{{ $visit->diagnosis }}</td>
                                <td>{{ $visit->medications_prescribed }}</td>
                                <td>{{ $visit->is_approved }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="text-primary font-weight-bold">Health Vitals Summary</h3>
                    <p>Latest Heart Rate: {{ $userVisits->last()->heart_rate }}</p>
                    <p>Latest Sugar Level: {{ $userVisits->last()->sugar_level }}</p>
                    <p>Latest Temperature: {{ $userVisits->last()->temperature }}</p>
                    <p>Oxygen Level: {{ $userVisits->last()->oxygen_level }}</p>

                    <h3 class="text-primary font-weight-bold">Current Treatment Plan</h3>
                    <p>Medications: {{ $userVisits->last()->medications_prescribed }}</p>
                    <p>Ongoing Treatments: {{ $userVisits->last()->ongoing_treatments }}</p>
                    <p>Doctor’s Recommendations: {{ $userVisits->last()->doctor_notes }}</p>

                    <h3 class="text-primary font-weight-bold">Next Steps & Follow-up</h3>
                    <p>Next Visit Date: {{ $userVisits->last()->preferred_visit_date }}</p>
                    <p>Emergency Contact for Queries: {{ $patients->find($selectedPatientId)->emergency_contact_name }}, {{ $patients->find($selectedPatientId)->emergency_contact_phone }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
