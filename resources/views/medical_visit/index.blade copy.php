@extends('layouts.app')

@section('content')
<div class="content"> <!-- Changed to text-xs for even smaller font size -->
    <!-- Content Header (Page header) -->
   

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

        .modal {
            display: none;
            position: fixed;
            z-index: 1050; /* Ensure the modal is on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            z-index: 1051; /* Ensure the modal content is on top */
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    <!-- Main content -->
    <section class="content">
        <div class="container mx-auto "> <!-- Added text-xs class -->
            <div class="flex justify-center">
                <div class="w-full">
                    <div class="bg-white shadow-lg rounded-lg"> <!-- Tailwind classes for card -->
                        <div class="bg-teal-500 text-white p-4 rounded-t-lg text-m"> <!-- Added text-xs class -->
                            <h3 class="text-lg font-semibold">Medical Visits List</h3>
                            
                            <form action="{{ route('medical_visit.index') }}" method="GET" class="flex gap-2 items-center"> <!-- Updated class -->
                                <input type="text" name="search" class="p-2 border rounded w-full text-black" placeholder="Search Medical history">
                                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Search</button>
                                <button id="settingsButton" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">Filters</button> <!-- Moved inside form -->
                            </form>
                        </div>
                        <div class="p-4 table-responsive text-s"> <!-- Added text-xs class -->
                            <!-- Settings Button -->
                            
                            <!-- End Settings Button -->

                            <!-- Settings Modal -->
                            <div id="settingsModal" class="modal">
                                <div class="modal-content">
                                    <span class="close">&times;</span>
                                    <h4 class="font-semibold mb-2">Select Columns to Display</h4>
                                    <div class="grid grid-cols-2 gap-2">
                                        <label><input type="checkbox" class="column-toggle" data-column="0" checked> Patient Unique ID</label>
                                        <label><input type="checkbox" class="column-toggle" data-column="1" checked> Patient Name</label>
                                        <label><input type="checkbox" class="column-toggle" data-column="2" checked> Visit Date</label>
                                        <label><input type="checkbox" class="column-toggle" data-column="3" checked> Doctor</label>
                                        <label><input type="checkbox" class="column-toggle" data-column="4" checked> Nurse</label>
                                        <label><input type="checkbox" class="column-toggle" data-column="5" checked> Appointment Status</label>
                                        @can('medical-visit-update-status')
                                        <label><input type="checkbox" class="column-toggle" data-column="6" checked> Medical Status</label>
                                        @endcan
                                        <label><input type="checkbox" class="column-toggle" data-column="7" checked> Actions</label>
                                    </div>
                                </div>
                            </div>
                            <!-- End Settings Modal -->

                            @if($medicalVisits)
                            <table id="medicalVisitsTable" class="min-w-full bg-white">
                                <thead>
                                    <tr>
                                        <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Patient Unique ID</th>
                                        <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Patient Name</th>
                                        <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Visit Date</th>
                                        <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Doctor</th>
                                        <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Nurse</th>
                                        <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Appointment Status</th>
                                        <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Medical Status</th>
                                       <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($medicalVisits as $visit)
                                        @if(auth()->user()->hasRole('Admin') || Auth::user()->id == $visit->created_by || Auth::user()->id == $visit->doctor_id || Auth::user()->name == $visit->nurse_id)
                                        <tr class="border-b {{ $visit->is_emergency ? 'emergency' : '' }}">
                                            <td class="py-2 px-1">{{ $visit->patient->pat_unique_id }}</td>
                                            <td class="py-2 px-1">{{ $visit->patient->full_name }}</td>
                                            <td class="py-2 px-1">{{ $visit->visit_date ?? 'N/A'  }}</td>
                                            <td class="py-2 px-1">{{ $visit->doctor->name ?? 'N/A' }}</td>
                                            <td class="py-2 px-1">{{ $visit->nurse->name ?? 'N/A' }}</td>
                                            <td class="py-2 px-1">{{ $visit->is_approved }}</td>
                                            @can('medical-visit-update-status', $visit)
                                            <td class="py-2 px-1">
                                                <form action="{{ route('medical_visit.update_status', $visit->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <select name="medical_status" onchange="this.form.submit()" class="action-buttons">
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
                                                    @can('medical-visit-reschedule', $visit)
                                                    <button class="btn btn-warning text-white bg-yellow-500 hover:bg-yellow-700" data-toggle="modal" data-target="#rescheduleModal-{{ $visit->id }}">Reschedule</button>
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

@foreach($medicalVisits as $visit)
<div class="modal fade" id="rescheduleModal-{{ $visit->id }}" tabindex="-1" role="dialog" aria-labelledby="rescheduleModalLabel-{{ $visit->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rescheduleModalLabel-{{ $visit->id }}">Reschedule Medical Visit</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('medical_visit.reschedule', $visit->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label for="visit_date">Visit Date</label>
                        <input type="date" name="visit_date" id="visit_date" class="form-control" value="{{ $visit->visit_date }}" required>
                    </div>
                    <div class="form-group">
                        <label for="time_slot">Time Slot</label>
                        <input type="time" name="time_slot" id="time_slot" class="form-control" value="{{ $visit->time_slot }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Reschedule</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

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

        // Toggle settings modal
        var modal = document.getElementById('settingsModal');
        var btn = document.getElementById('settingsButton');
        var span = document.getElementsByClassName('close')[0];

        btn.onclick = function(event) {
            event.preventDefault(); // Prevent form submission
            modal.style.display = 'block';
        }

        span.onclick = function() {
            modal.style.display = 'none';
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        }

        // Handle column visibility
        var checkboxes = document.querySelectorAll('.column-toggle');
        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                var column = this.getAttribute('data-column');
                var cells = document.querySelectorAll('#medicalVisitsTable th:nth-child(' + (parseInt(column) + 1) + '), #medicalVisitsTable td:nth-child(' + (parseInt(column) + 1) + ')');
                cells.forEach(function (cell) {
                    cell.style.display = checkbox.checked ? '' : 'none';
                });
            });
        });

        // Handle reschedule modal
        var rescheduleButtons = document.querySelectorAll('[data-toggle="modal"]');
        rescheduleButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                var target = button.getAttribute('data-target');
                var modal = document.querySelector(target);
                $(modal).modal('show');
            });
        });
    });
</script>
@endsection
