@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Medical Visits Management</h2>
        <a class="btn btn-success mb-2" href="{{ route('medical_visit.create') }}"><i class="fa fa-plus"></i> Create New Visit</a>
    </div>

    @session('success')
    <div class="alert alert-success" role="alert">
        {{ $value }}
    </div>
    @endsession

    <table id="medical-visits-table" class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Patient Unique ID</th>
                <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Patient Name</th>
                <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Visit Date</th>
                <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Doctor</th>
                <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Nurse</th>
                <th class="py-2 px-1 text-left text-sm font-medium text-gray-700">Appointment Status</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700" width="280px">Action</th>
            </tr>
        </thead>
        <tbody id="medical-visit-table-body">
            @foreach ($data as $key => $visit)
            <tr class="border-b" id="visit-row-{{ $visit->id }}">
                <td class="py-2 px-1">{{ $visit->patient->pat_unique_id }}</td>
                <td class="py-2 px-1">{{ $visit->patient->full_name }}</td>
                <td class="py-2 px-1">{{ $visit->visit_date ?? 'N/A'  }}</td>
                <td class="py-2 px-1">{{ $visit->doctor->name ?? 'N/A' }}</td>
                <td class="py-2 px-1">{{ $visit->nurse->name ?? 'N/A' }}</td>
                <td class="py-2 px-1">{{ $visit->is_approved }}</td>
                <td class="py-2 px-4">
                    <a class="btn btn-info btn-sm" href="{{ route('medical_visit.show',$visit->id) }}"><i class="fas fa-list"></i> Show</a>
                    <a class="btn btn-primary btn-sm" href="{{ route('medical_visit.edit',$visit->id) }}"><i class="	fas fa-pencil-alt"></i> Edit</a>
                    <button class="btn btn-danger btn-sm delete-visit" data-id="{{ $visit->id }}"><i class="fas fa-trash"></i> Delete</button>
                    <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#rescheduleModal-{{ $visit->id }}"><i class="fas fa-calendar-alt"></i> Reschedule</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@foreach ($data as $key => $visit)
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
    document.addEventListener('DOMContentLoaded', function() {
        $('#medical-visits-table').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "destroy": true
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