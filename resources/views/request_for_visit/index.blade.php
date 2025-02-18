@extends('layouts.app')

@section('content')
<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Requested Medical Visits</h1>
                @if(Auth::check())
                <span class="badge badge-primary slide-in text-lg">Logged in as : {{ Auth::user()->name }}</span>
                @endif
            </div>
        </div>
    </section>

    <style>
        @keyframes slideIn {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(0);
            }
        }

        .slide-in {
            animation: slideIn 2s;
        }

        .emergency {
            background-color: rgba(255, 0, 0, 0.1);
        }
    </style>

    <!-- Main content -->
    <section class="content">
        <div class="container mx-auto">
            <div class="flex justify-center">
                <div class="w-full">
                    <div class="bg-white shadow-lg rounded-lg"> <!-- Tailwind classes for card -->
                        <div class="bg-teal-500 text-white p-4 rounded-t-lg"> <!-- Tailwind classes for header -->
                            <h3 class="text-lg font-semibold">Medical Visits List</h3>
                        </div>
                        <div class="p-4">
                            @if($medicalVisits)
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Patient Unique ID</th>
                                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Patient Name</th>
                                        <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Preferred Visit Date</th>
                                        <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Preferred Time Slot</th>
                                       
                                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Approval Status</th>
                                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $pendingVisits = $medicalVisits->filter(function($visit) {
                                    return $visit->is_approved == 'pending';
                                    });
                                    $emergencyVisits = $medicalVisits->filter(function($visit) {
                                    return $visit->is_emergency == true;
                                    });
                                    @endphp
                                    @foreach($pendingVisits as $visit)
                                    <tr class="border-b {{ $visit->is_emergency ? 'emergency' : '' }}">
                                        <td class="py-2 px-4">{{ $visit->patient->pat_unique_id }}</td>
                                        <td class="py-2 px-4">{{ $visit->patient->full_name }} {{ $visit->patient->middle_name}} {{ $visit->patient->last_name}}</td>
                                        <td class="py-2 px-1">{{ $visit->preferred_visit_date }}</td>
                                        <td class="py-2 px-1">{{ $visit->preferred_time_slot }}</td>
                                        <td class="py-2 px-4">{{ $visit->is_approved ? 'Pending' : 'Approved' }}</td>
                                        <td class="py-2 px-4"><button class="btn btn-primary" data-toggle="modal" data-target="#approveModal-{{ $visit->id }}">Approve</button></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p>No medical visits available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@foreach($pendingVisits as $visit)
<div class="modal fade" id="approveModal-{{ $visit->id }}" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel-{{ $visit->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveModalLabel-{{ $visit->id }}">Approve Medical Visit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('medical_visit.approve', $visit->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="visit_date">Visit Date</label>
                        <input type="date" name="visit_date" id="visit_date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="time_slot">Time Slot</label>
                        <input type="time" name="time_slot" id="time_slot" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="doctor_id">Doctor</label>
                        <select name="doctor_id" id="doctor_id-{{ $visit->id }}" class="form-control" required onchange="updateDoctorName(this, 'doctor_name-{{ $visit->id }}')">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nurse_id">Nurse</label>
                        <select name="nurse_id" id="nurse_id-{{ $visit->id }}" class="form-control" required onchange="updateNurseName(this, 'nurse_name-{{ $visit->id }}')">
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success mt-2">Approve</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        @foreach($pendingVisits as $visit)
        fetchUsersWithRole('doctor', 'doctor_id-{{ $visit->id }}');
        fetchUsersWithRole('nurse', 'nurse_id-{{ $visit->id }}');
        @endforeach

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

        function updateDoctorName(select, inputId) {
            const selectedOption = select.options[select.selectedIndex];
            document.getElementById(inputId).value = selectedOption.textContent;
        }

        function updateNurseName(select, inputId) {
            const selectedOption = select.options[select.selectedIndex];
            document.getElementById(inputId).value = selectedOption.textContent;
        }
    });
</script>
@endsection