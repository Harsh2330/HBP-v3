@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-center mb-4 text-blue-600 font-bold text-2xl">Personal Medical Summary</h1>
    <div class="flex justify-center">
        <div class="w-full lg:w-3/4">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-blue-600 font-bold text-xl mb-4">Select Patient</h3>
                <form method="GET" action="{{ route('reports.user') }}">
                    <div class="mb-4">
                        <select name="patient_id" class="form-control block w-full mt-1 rounded-md border-gray-300 shadow-sm" onchange="this.form.submit()">
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}" {{ $selectedPatientId == $patient->id ? 'selected' : '' }}>
                                    {{ $patient->full_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date:</label>
                        <input type="date" name="start_date" class="form-control block w-full mt-1 rounded-md border-gray-300 shadow-sm" value="{{ $startDate }}">
                    </div>
                    <div class="mb-4">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date:</label>
                        <input type="date" name="end_date" class="form-control block w-full mt-1 rounded-md border-gray-300 shadow-sm" value="{{ $endDate }}">
                    </div>
                    <button type="submit" class="btn btn-primary bg-blue-600 text-white py-2 px-4 rounded-md">Filter</button>
                </form>
                @if($selectedPatientId && !empty($userVisits))
                <h3 class="text-blue-600 font-bold text-xl mt-6">Patient Profile</h3>
                <p>Name: {{ $patients->find($selectedPatientId)->full_name }}</p>
                <p>Patient ID: {{ $patients->find($selectedPatientId)->pat_unique_id }}</p>
                <p>Gender: {{ $patients->find($selectedPatientId)->gender }}</p>
                <p>Date of Birth: {{ $patients->find($selectedPatientId)->date_of_birth }}</p>
                <p>Contact Number: {{ $patients->find($selectedPatientId)->phone_number }}</p>
                <p>Email: {{ $patients->find($selectedPatientId)->email ?? 'N/A' }}</p>
                <p>Emergency Contact: {{ $patients->find($selectedPatientId)->emergency_contact_name ?? 'N/A' }} – {{ $patients->find($selectedPatientId)->emergency_contact_relationship ?? 'N/A' }} ({{ $patients->find($selectedPatientId)->emergency_contact_phone ?? 'N/A' }})</p>

                <h3 class="text-blue-600 font-bold text-xl mt-6">Recent Medical Visits</h3>
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Visit Date</th>
                            <th class="py-2 px-4 border-b">Doctor</th>
                            <th class="py-2 px-4 border-b">Complaint</th>
                            <th class="py-2 px-4 border-b">Diagnosis</th>
                            <th class="py-2 px-4 border-b">Medications</th>
                            <th class="py-2 px-4 border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userVisits as $visit)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $visit->visit_date }}</td>
                            <td class="py-2 px-4 border-b">{{ $visit->doctor->name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $visit->primary_complaint ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $visit->diagnosis ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $visit->medications_prescribed ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $visit->is_approved ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3 class="text-blue-600 font-bold text-xl mt-6">Health Vitals Summary</h3>
                <p>Latest Heart Rate: {{ $userVisits->last()->heart_rate ?? 'N/A' }}</p>
                <p>Latest Sugar Level: {{ $userVisits->last()->sugar_level ?? 'N/A' }}</p>
                <p>Latest Temperature: {{ $userVisits->last()->temperature ?? 'N/A' }}</p>
                <p>Oxygen Level: {{ $userVisits->last()->oxygen_level ?? 'N/A' }}</p>

                <h3 class="text-blue-600 font-bold text-xl mt-6">Current Treatment Plan</h3>
                <p>Medications: {{ $userVisits->last()->medications_prescribed ?? 'N/A' }}</p>
                <p>Ongoing Treatments: {{ $userVisits->last()->ongoing_treatments ?? 'N/A' }}</p>
                <p>Procedures Done: {{ $userVisits->last()->procedures ?? 'N/A' }}</p>
                <p>Doctor’s Recommendations: {{ $userVisits->last()->doctor_notes ?? 'N/A' }}</p>

                <h3 class="text-blue-600 font-bold text-xl mt-6">Next Steps & Follow-up</h3>
                <p>Next Visit Date: {{ $userVisits->last()->preferred_visit_date ?? 'N/A' }}</p>
                <p>Preferred Time Slot: {{ $userVisits->last()->preferred_time_slot ?? 'N/A' }}</p>
                <p>Is Emergency Case?: {{ $userVisits->last()->is_emergency ? 'Yes' : 'No' }}</p>
                <p>Emergency Contact for Queries: {{ $patients->find($selectedPatientId)->emergency_contact_name ?? 'N/A' }}, {{ $patients->find($selectedPatientId)->emergency_contact_phone ?? 'N/A' }}</p>

                <h3 class="text-blue-600 font-bold text-xl mt-6">Report Summary for Period</h3>
                <p>Total Visits: {{ $userVisits->count() }}</p>
                <p>New Diagnoses: {{ $userVisits->pluck('diagnosis')->unique()->implode(', ') ?? 'N/A' }}</p>
                <p>Medications Prescribed: {{ $userVisits->pluck('medications_prescribed')->unique()->implode(', ') ?? 'N/A' }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
