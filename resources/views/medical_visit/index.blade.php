@extends('layouts.app')

@section('content')
<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container mx-auto">
            
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Medical Visits Management</h1>
                <a class="btn btn-success mb-2" href="{{ route('medical_visit.create') }}"><i class="fa fa-plus"></i> Create New Visit</a>
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
            background-color: rgba(146, 193, 150, 0.2)!important;
        }

        #medical-visits-table_filter input {
            width: 600px !important; /* Adjust width as needed */
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        table {
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

    </style>

    <!-- Main content -->
    <section class="content">
        <div class="container mx-auto">
            <div class="flex justify-center">
                <div class="w-full">
                    <div class="bg-white shadow-lg rounded-lg"> <!-- Tailwind classes for card -->
                    <div class="bg-teal-500 text-white p-4 rounded-t-lg flex justify-between items-center">
                        <h3 class="text-lg font-semibold">Medical Visits List</h3>
                        <div id="customSearchContainer"></div>
                    </div>

                        <div class="p-4">
                            @session('success')
                            <div class="alert alert-success" role="alert">
                                {{ $value }}
                            </div>
                            @endsession

                            <div class="flex mb-4">
                                <input type="date" id="start-date" class="form-control mr-2" placeholder="Start Date">
                                <input type="date" id="end-date" class="form-control mr-2" placeholder="End Date">
                                <select id="doctor-select" class="form-control mr-2">
                                    <option value="">Select Doctor</option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->name }}">{{ $doctor->name }}</option>
                                    @endforeach
                                </select>
                                <button id="filter-date-range" class="btn btn-primary">Filter</button>
                            </div>

                            <table id='medical-visits-table'  class="min-w-full bg-white">
                            <thead>
                                <tr>
                                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Patient Unique ID</th>
                                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Patient Name</th>
                                    <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Visit Date</th>
                                    <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Doctor</th>
                                    <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Nurse</th>
                                    <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Appointment Status</th>
                                    @can('medical-visit-update-status')
                                    <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Medical Status</th>
                                    @endcan
                                    <th class="py-2 px-4 text-left text-sm font-medium text-gray-700" width="280px">Action</th>    
                                </tr>
                            </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    var table = $('#medical-visits-table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "{{ route('medical_visits.data') }}",
            "data": function(d) {
                d.status = 'Approved'; // Only fetch approved records
            }
        },
        "columns": [
            { "data": "patient.pat_unique_id" },
            { "data": "patient.full_name" },
            { "data": "visit_date" },
            { "data": "doctor.name" },
            { "data": "nurse.name" },
            { "data": "is_approved" },
            { "data": "medical_status" },
            { "data": "action", "orderable": false, "searchable": false }
        ],
        "paging": true,
        "searching": true,
        "ordering": true,
        "destroy": true,
        "dom": '<"top"lfB>rt<"bottom"ip><"clear">',
        "buttons": [
            {
            extend: 'csvHtml5',
            text: 'CSV',
            exportOptions: {
                columns: [0, 1, 2, 3, 4] // Specify the column indexes you want
            }
            },
            {
            extend: 'excelHtml5',
            text: 'Excel',
            exportOptions: {
                columns: [0, 1, 2, 3, 4] // Specify the column indexes you want
            },
            customize: function (xlsx) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                $('row c[r^="C"]', sheet).attr('s', '2'); // Example customization
            }
            },
            {
            extend: 'pdfHtml5',
            text: 'PDF',
            exportOptions: {
                columns: [0, 1, 2, 3, 4] // Specify the column indexes you want
            },
            customize: function (doc) {
                doc.content[1].table.widths = ['20%', '20%', '15%', '15%', '15%', '15%']; // Adjust column widths if needed
            }
            }
        ]
    });

    $('#medical-visits-table_filter').detach().appendTo('#customSearchContainer');

    // Remove the default "Search:" label
    $('#medical-visits-table_filter label').contents().filter(function() {
        return this.nodeType === 3; // Select text nodes
    }).remove();

    // Style the search input field
    $('#medical-visits-table_filter input')
        .attr('placeholder', 'Search Medical Visits...')
        .css({
            'color': 'black',
            'font-weight': 'bold'
        });

    document.querySelectorAll('.delete-visit').forEach(button => {
        button.addEventListener('click', function() {
            const visitId = this.getAttribute('data-id');
            fetch(`/medical_visits/${visitId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`visit-row-${visitId}`).remove();
                    } else {
                        alert('Error deleting visit');
                    }
                });
        });
    });

    document.querySelectorAll('.delete-patient').forEach(button => {
        button.addEventListener('click', function() {
            const patientId = this.getAttribute('data-id');
            fetch(`/patients/${patientId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelectorAll(`[data-patient-id="${patientId}"]`).forEach(row => row.remove());
                    } else {
                        alert('Error deleting patient');
                    }
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

        // Date range and doctor filter
        $('#filter-date-range').on('click', function() {
            var startDate = $('#start-date').val();
            var endDate = $('#end-date').val();
            var selectedDoctor = $('#doctor-select').val();
            console.log('Filter button clicked');
            console.log('Start Date:', startDate);
            console.log('End Date:', endDate);
            console.log('Selected Doctor:', selectedDoctor);
            $.fn.dataTable.ext.search = []; // Clear any existing filters
            if (startDate || endDate || selectedDoctor) {   
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var visitDate = new Date(data[2]); // Use the correct column index for visit date
                        var start = startDate ? new Date(startDate) : null;
                        var end = endDate ? new Date(endDate) : null;
                        var doctor = data[3]; // Use the correct column index for doctor
                        console.log('Visit Date:', visitDate);
                        if ((start && visitDate < start) || (end && visitDate > end)) {
                            return false;
                        }
                        if (selectedDoctor && doctor !== selectedDoctor) {
                            return false;
                        }
                        return true;
                    }
                );
            }
            table.draw(); // Trigger the draw event to show filtered entries
            console.log('Table redrawn');
        });
    });
</script>
@endsection