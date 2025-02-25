@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-center mb-4 text-blue-600 font-bold text-2xl">Hospital Activity Report</h1>
   
    <div class="flex justify-center">
        <div class="w-full lg:w-3/4">
            <div class="bg-white shadow-lg rounded-lg p-6">
                <h3 class="text-blue-600 font-bold text-xl mb-4">Filter by Date Range</h3>
                <form method="GET" action="{{ route('reports.admin') }}">
                    <div class="mb-4">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Start Date:</label>
                        <input type="date" name="start_date" class="form-control block w-full mt-1 rounded-md border-gray-300 shadow-sm" value="{{ $startDate }}">
                    </div>
                    <div class="mb-4">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">End Date:</label>
                        <input type="date" name="end_date" class="form-control block w-full mt-1 rounded-md border-gray-300 shadow-sm" value="{{ $endDate }}">
                    </div>
                    <button type="submit" class="btn btn-primary bg-blue-600 text-white py-2 px-4 rounded-md">Filter</button>
                    <a href="{{ route('reports.admin') }}" class="btn btn-secondary bg-gray-600 text-white py-2 px-4 rounded-md">Clear Filter</a>
                </form>

                <h3 class="text-blue-600 font-bold text-xl mt-6">Summary Statistics</h3>
                <p>Total Patients Registered: {{ $totalPatients ?? 'N/A' }}</p>
                <p>Total Visits This Month: {{ $totalVisits ?? 'N/A' }}</p>
                <p>Approved Visits: {{ $approvedVisits ?? 'N/A' }}</p>
                <p>Pending Visits: {{ $pendingVisits ?? 'N/A' }}</p>
                <p>Emergency Visits: {{ $emergencyCases ?? 'N/A' }}</p>

                <h3 class="text-blue-600 font-bold text-xl mt-6">Doctor-wise Visit Breakdown</h3>
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Doctor Name</th>
                            <th class="py-2 px-4 border-b">Patients Seen</th>
                            <th class="py-2 px-4 border-b">Pending Visits</th>
                            <th class="py-2 px-4 border-b">Completed Visits</th>
                            <th class="py-2 px-4 border-b">Emergency Visits</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($doctorPerformance as $doctor)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $doctor->name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $doctor->patients_seen ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $doctor->pending_visits ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $doctor->completed_visits ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $doctor->emergency_visits ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3 class="text-blue-600 font-bold text-xl mt-6">Patient Demographics</h3>
                <p>Male Patients: {{ $malePatients ?? 'N/A' }}</p>
                <p>Female Patients: {{ $femalePatients ?? 'N/A' }}</p>
                <p>Other Gender: {{ $otherGenderPatients ?? 'N/A' }}</p>
                <p>Age Distribution:</p>
                <ul class="list-disc list-inside">
                    <li>Children (0-12): {{ $childrenCount ?? 'N/A' }}</li>
                    <li>Teenagers (13-19): {{ $teenagersCount ?? 'N/A' }}</li>
                    <li>Adults (20-59): {{ $adultsCount ?? 'N/A' }}</li>
                    <li>Seniors (60+): {{ $seniorsCount ?? 'N/A' }}</li>
                </ul>

                <h3 class="text-blue-600 font-bold text-xl mt-6">Common Diagnoses & Treatments</h3>
                <p>Top 5 Most Diagnosed Conditions:</p>
                <ul class="list-disc list-inside">
                    @foreach($topDiagnoses as $diagnosis)
                    <li>{{ $diagnosis->name }}</li>
                    @endforeach
                </ul>
                <p>Top 5 Most Prescribed Medications:</p>
                <ul class="list-disc list-inside">
                    @foreach($topMedications as $medication)
                    <li>{{ $medication->name }}</li>
                    @endforeach
                </ul>
                <p>Common Procedures Done:</p>
                <ul class="list-disc list-inside">
                    @foreach($commonProcedures as $procedure)
                    <li>{{ $procedure->name }}</li>
                    @endforeach
                </ul>

                <h3 class="text-blue-600 font-bold text-xl mt-6">Appointment Summary</h3>
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Visit Date</th>
                            <th class="py-2 px-4 border-b">Patient Name</th>
                            <th class="py-2 px-4 border-b">Doctor Assigned</th>
                            <th class="py-2 px-4 border-b">Appointment Type</th>
                            <th class="py-2 px-4 border-b">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($appointments as $appointment)
                        <tr>
                            <td class="py-2 px-4 border-b">{{ $appointment->visit_date ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $appointment->patient->full_name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $appointment->doctor->name ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $appointment->appointment_type ?? 'N/A' }}</td>
                            <td class="py-2 px-4 border-b">{{ $appointment->is_approved ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
