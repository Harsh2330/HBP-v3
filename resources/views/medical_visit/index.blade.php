@extends('layouts.app')

@section('content')
<div class="content text-xs"> <!-- Changed to text-xs for even smaller font size -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container mx-auto text-xs"> <!-- Added text-xs class -->
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

        .table-responsive {
            overflow-x: auto;
        }

        @media (max-width: 640px) {
            th, td {
                font-size: 0.65rem; /* Smaller font size for table headers and cells on small screens */
                padding: 0.25rem; /* Smaller padding for table cells */
            }
            .btn {
                font-size: 0.65rem; /* Smaller font size for buttons */
                padding: 0.1rem 0.3rem; /* Smaller padding for buttons */
            }
        }

        .emergency {
            background-color: #f8d7da; /* Light red background for emergency visits */
        }

        .btn {
            padding: 0.2rem 0.5rem; /* Smaller padding for buttons */
            font-size: 0.75rem; /* Smaller font size for buttons */
            white-space: nowrap; /* Prevent text from wrapping */
        }

        .action-buttons {
            display: flex;
            gap: 0.25rem; /* Small gap between buttons */
        }

        .accordion {
            cursor: pointer;
            transition: background-color 0.6s ease;
        }

        .accordion:hover {
            background-color: #f1f1f1;
        }

        .panel {
            padding: 0 18px;
            display: none;
            background-color: white;
            overflow: hidden;
        }
    </style>

    <!-- Main content -->
    <section class="content">
        <div class="container mx-auto text-xs"> <!-- Added text-xs class -->
            <div class="flex justify-center">
                <div class="w-full">
                    <div class="bg-white shadow-lg rounded-lg"> <!-- Tailwind classes for card -->
                        <div class="bg-teal-500 text-white p-4 rounded-t-lg text-xs"> <!-- Added text-xs class -->
                            <h3 class="text-lg font-semibold">Medical Visits List</h3>
                            <form action="{{ route('medical_visit.index') }}" method="GET" class="flex gap-2">
                                <input type="text" name="search" class="p-2 border rounded w-full" placeholder="Search Medical history">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Search</button>
                            </form>
                        </div>
                        <div class="p-4 table-responsive text-xs"> <!-- Added text-xs class -->
                            @if($medicalVisits)
                            <table class="min-w-full bg-white">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Patient Unique ID</th>
                                        <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Patient Name</th>
                                        <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Visit Date</th>
                                        <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Doctor</th>
                                        <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Nurse</th>
                                        <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Appointment Status</th>
                                        @can('medical-visit-update-status')<th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Medical Status</th>@endcan
                                        <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($medicalVisits as $visit)
                                        @if(auth()->user()->hasRole('Admin') || Auth::user()->id == $visit->created_by || Auth::user()->id == $visit->doctor_id || Auth::user()->name == $visit->nurse_id)
                                        <tr class="border-b {{ $visit->is_emergency ? 'emergency' : '' }}">
                                            <td class="py-2 px-1">{{ $visit->patient->pat_unique_id }}</td>
                                            <td class="py-2 px-1">{{ $visit->patient->full_name }}</td>
                                            <td class="py-2 px-1">{{ $visit->visit_date }}</td>
                                            <td class="py-2 px-1">{{ $visit->doctor->name }}</td>
                                            <td class="py-2 px-1">{{ $visit->nurse->name }}</td>
                                            <td class="py-2 px-1">{{ $visit->is_approved }}</td>
                                            @can('medical-visit-update-status', $visit)
                                            <td class="py-2 px-1">
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
                                            @endcan
                                            <td class="py-2 px-1">
                                                <div class="action-buttons">
                                                    @can('medical-visit-create', $visit)
                                                    <a href="{{ route('medical_visit.show', $visit->id) }}" class="btn btn-info text-white bg-blue-500 hover:bg-blue-700">View Visit</a>
                                                    @endcan
                                                    @can('medical-visit-edit', $visit)
                                                    <a href="{{ route('medical_visit.edit', $visit->id) }}" class="btn btn-primary text-white bg-green-500 hover:bg-green-700">Edit Visit</a>
                                                    @endcan
                                                    @can('medical-visit-delete', $visit)
                                                    <form action="{{ route('medical_visit.destroy', $visit->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger text-white bg-red-500 hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this visit?')">Delete</button>
                                                    </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                    <tr>
                                        <td colspan="8" class="py-2 px-4">
                                            @can('medical-visit-create', App\Models\MedicalVisit::class)
                                            <a href="{{ route('medical_visit.create') }}" class="btn btn-success">Add New Visit</a>
                                            @endcan
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var acc = document.getElementsByClassName("accordion");
        for (var i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.display === "block") {
                    panel.style.display = "none";
                } else {
                    panel.style.display = "block";
                }
            });
        }
    });
</script>
@endsection
