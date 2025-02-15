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
                                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Visit Date</th>
                                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Action</th>
                                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Approval Status</th>
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
                                        <td class="py-2 px-4">{{ $visit->visit_date }}</td>
                                        <td class="py-2 px-4">
                                            <form action="{{ route('medical_visit.approve', $visit->id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="hidden" name="is_approved" value="Approved">
                                                <select name="time_slot" class="form-control">
                                                    <option value="9 AM - 11 AM">9 AM - 11 AM</option>
                                                    <option value="11 AM - 1 PM">11 AM - 1 PM</option>
                                                    <option value="1 PM - 3 PM">1 PM - 3 PM</option>
                                                    <option value="3 PM - 5 PM">3 PM - 5 PM</option>
                                                </select>
                                                <button type="submit" class="btn btn-success mt-2">Approve</button>
                                            </form>
                                        </td>
                                        <td class="py-2 px-4">
                                            {{ $visit->is_approved ? 'Pending' : 'Approved' }}
                                        </td>
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
    <!-- /.content -->
</div>
@endsection
