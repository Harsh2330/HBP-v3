@extends('layouts.app')

@section('content')
<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container mx-auto">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Medical Visits</h1>
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
                                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Doctor</th>
                                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Nurse</th>
                                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Appointment Status</th>
                                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Medical Status</th>
                                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($medicalVisits as $visit)
                                        @if(Auth::user()->id == $visit->created_by)
                                        <tr class="border-b">
                                            <td class="py-2 px-4">{{ $visit->patient->pat_unique_id }}</td>
                                            <td class="py-2 px-4">{{ $visit->patient->full_name }}</td>
                                            <!-- ...existing code... -->
                                            <td class="py-2 px-4">{{ $visit->visit_date }}</td>
                                            <td class="py-2 px-4">{{ $visit->doctor->name }}</td>
                                            <td class="py-2 px-4">{{ $visit->nurse->name}}</td>
                                            <!-- <td class="py-2 px-4">{{ $visit->simplified_diagnosis }}</td> -->
                                            <td class="py-2 px-4">{{ $visit->is_approved }}</td>
                                            
                                            <td class="py-2 px-4">
                                                <form action="{{ route('medical_visit.update_status', $visit->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="medical_status" onchange="this.form.submit()" class="form-control">
                                                        <option value="Pending" {{ $visit->medical_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                        <option value="Completed" {{ $visit->medical_status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                        <option value="Cancelled" {{ $visit->medical_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                    </select>
                                                </form>
                                            </td>
                                            
                                            <td class="py-2 px-4">
                                                <a href="{{ route('medical_visit.show', $visit->id) }}" class="btn btn-info">View Visit</a>
                                                <a href="{{ route('medical_visit.edit', $visit->id) }}" class="btn btn-primary">Edit Visit</a>
                                                <form action="{{ route('medical_visit.destroy', $visit->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this visit?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td colspan="8" class="py-2 px-4">
                                            <a href="{{ route('medical_visit.create') }}" class="btn btn-success">Add New Visit</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            {{ $medicalVisits->links() }}
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
