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
                        <div class="form-group">
                            <label for="start_date">Start Date:</label>
                            <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End Date:</label>
                            <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </form>
                    @if($selectedPatientId && !empty($userVisits))
                    <h3 class="text-primary font-weight-bold">Patient Profile</h3>
                    <p>Name: {{ $patients->find($selectedPatientId)->full_name }}</p>
                    <p>Patient ID: {{ $patients->find($selectedPatientId)->pat_unique_id }}</p>
                    <p>Gender: {{ $patients->find($selectedPatientId)->gender }}</p>
                    <p>Date of Birth: {{ $patients->find($selectedPatientId)->date_of_birth }}</p>
                    <p>Contact Number: {{ $patients->find($selectedPatientId)->phone_number }}</p>
                    <p>Email: {{ $patients->find($selectedPatientId)->email ?? 'N/A' }}</p>
                    <p>Emergency Contact: {{ $patients->find($selectedPatientId)->emergency_contact_name ?? 'N/A' }} – {{ $patients->find($selectedPatientId)->emergency_contact_relationship ?? 'N/A' }} ({{ $patients->find($selectedPatientId)->emergency_contact_phone ?? 'N/A' }})</p>

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
                                <td>{{ $visit->doctor->name ?? 'N/A' }}</td>
                                <td>{{ $visit->primary_complaint ?? 'N/A' }}</td>
                                <td>{{ $visit->diagnosis ?? 'N/A' }}</td>
                                <td>{{ $visit->medications_prescribed ?? 'N/A' }}</td>
                                <td>{{ $visit->is_approved ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h3 class="text-primary font-weight-bold">Health Vitals Summary</h3>
                    <p>Latest Heart Rate: {{ $userVisits->last()->heart_rate ?? 'N/A' }}</p>
                    <p>Latest Sugar Level: {{ $userVisits->last()->sugar_level ?? 'N/A' }}</p>
                    <p>Latest Temperature: {{ $userVisits->last()->temperature ?? 'N/A' }}</p>
                    <p>Oxygen Level: {{ $userVisits->last()->oxygen_level ?? 'N/A' }}</p>

                    <h3 class="text-primary font-weight-bold">Current Treatment Plan</h3>
                    <p>Medications: {{ $userVisits->last()->medications_prescribed ?? 'N/A' }}</p>
                    <p>Ongoing Treatments: {{ $userVisits->last()->ongoing_treatments ?? 'N/A' }}</p>
                    <p>Procedures Done: {{ $userVisits->last()->procedures ?? 'N/A' }}</p>
                    <p>Doctor’s Recommendations: {{ $userVisits->last()->doctor_notes ?? 'N/A' }}</p>

                    <h3 class="text-primary font-weight-bold">Next Steps & Follow-up</h3>
                    <p>Next Visit Date: {{ $userVisits->last()->preferred_visit_date ?? 'N/A' }}</p>
                    <p>Preferred Time Slot: {{ $userVisits->last()->preferred_time_slot ?? 'N/A' }}</p>
                    <p>Is Emergency Case?: {{ $userVisits->last()->is_emergency ? 'Yes' : 'No' }}</p>
                    <p>Emergency Contact for Queries: {{ $patients->find($selectedPatientId)->emergency_contact_name ?? 'N/A' }}, {{ $patients->find($selectedPatientId)->emergency_contact_phone ?? 'N/A' }}</p>

                    <h3 class="text-primary font-weight-bold">Report Summary for Period</h3>
                    <p>Total Visits: {{ $userVisits->count() }}</p>
                    <p>New Diagnoses: {{ $userVisits->pluck('diagnosis')->unique()->implode(', ') ?? 'N/A' }}</p>
                    <p>Medications Prescribed: {{ $userVisits->pluck('medications_prescribed')->unique()->implode(', ') ?? 'N/A' }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
