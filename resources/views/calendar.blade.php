@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4 text-primary font-weight-bold">Medical Visits Calendar</h1>
    <div id="calendar"></div>
</div>

<!-- Modal for adding/editing/rescheduling visits -->
<div class="modal fade" id="visitModal" tabindex="-1" role="dialog" aria-labelledby="visitModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="visitModalLabel">Visit Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="visitForm">
                    @csrf
                    <input type="hidden" name="visit_id" id="visit_id">
                    @php
                        $patients = auth()->user()->hasRole('Admin') ? \App\Models\Patient::all() : \App\Models\Patient::where('user_unique_id', auth()->user()->id)->get();
                    @endphp
                    <div class="form-group">
                        <label for="patient_id">Patient</label>
                        <select name="patient_id" id="patient_id" class="form-control">
                            @foreach($patients as $patient)
                                <option value="{{ $patient->id }}">{{ $patient->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="preferred_visit_date">Preferred Visit Date</label>
                        <input type="date" name="preferred_visit_date" id="preferred_visit_date" class="form-control" value="{{ old('preferred_visit_date') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="preferred_time_slot">Preferred Time Slot</label>
                        <input type="time" name="preferred_time_slot" id="preferred_time_slot" class="form-control" value="{{ old('preferred_time_slot') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="appointment_type">Appointment Type</label>
                        <select name="appointment_type" id="appointment_type" class="form-control" required>
                            <option value="Routine Checkup">Routine Checkup</option>
                            <option value="Follow-up Visit">Follow-up Visit</option>
                            <option value="Emergency Visit">Emergency Visit</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="primary_complaint">Primary Complaint</label>
                        <textarea name="primary_complaint" id="primary_complaint" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ensure jQuery is loaded
    if (typeof jQuery === 'undefined') {
        var script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js';
        document.head.appendChild(script);
    }

    // Ensure Bootstrap is loaded
    if (typeof $.fn.modal === 'undefined') {
        var script = document.createElement('script');
        script.src = 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js';
        document.head.appendChild(script);
    }

    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        editable: true,
        events: @json($events),
        dateClick: function(info) {
            $('#visitModal').modal('show');
            $('#visitForm')[0].reset();
            $('#visit_id').val('');
            $('#preferred_visit_date').val(info.dateStr);
        },
        eventClick: function(info) {
            var event = info.event;
            $('#visitModal').modal('show');
            $('#visit_id').val(event.id);
            $('#patient_id').val(event.extendedProps.patient_id);
            $('#preferred_visit_date').val(event.start.toISOString().slice(0, 10));
            $('#preferred_time_slot').val(event.start.toISOString().slice(11, 16));
            $('#appointment_type').val(event.extendedProps.appointment_type);
            $('#primary_complaint').val(event.extendedProps.primary_complaint);
        },
        eventDrop: function(info) {
            var event = info.event;
            var formData = {
                _token: '{{ csrf_token() }}',
                visit_date: event.start.toISOString().slice(0, 10),
                time_slot: event.start.toISOString().slice(11, 16)
            };
            $.ajax({
                url: '/medical_visit/' + event.id + '/reschedule',
                method: 'PATCH',
                data: formData,
                success: function(response) {
                    calendar.refetchEvents();
                },
                error: function() {
                    info.revert();
                }
            });
        },
        eventResize: function(info) {
            var event = info.event;
            var formData = {
                _token: '{{ csrf_token() }}',
                visit_date: event.start.toISOString().slice(0, 10),
                time_slot: event.start.toISOString().slice(11, 16)
            };
            $.ajax({
                url: '/medical_visit/' + event.id + '/reschedule',
                method: 'PATCH',
                data: formData,
                success: function(response) {
                    calendar.refetchEvents();
                },
                error: function() {
                    info.revert();
                }
            });
        }
    });
    calendar.render();

    $('#visitForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: $('#visit_id').val() ? '/medical_visit/' + $('#visit_id').val() : '/medical_visit',
            method: $('#visit_id').val() ? 'PATCH' : 'POST',
            data: formData,
            success: function(response) {
                $('#visitModal').modal('hide');
                calendar.refetchEvents();
            },
            error: function(response) {
                if (response.status === 422) {
                    var errors = response.responseJSON.errors;
                    var errorMessage = '';
                    for (var field in errors) {
                        errorMessage += errors[field].join(', ') + '\n';
                    }
                    alert('Validation error:\n' + errorMessage);
                } else {
                    alert('An error occurred while saving the visit.');
                }
            }
        });
    });
});
</script>

<style>
    .text-primary {
        color: #4e73df !important;
    }
    .font-weight-bold {
        font-weight: bold !important;
    }
</style>
@endsection
