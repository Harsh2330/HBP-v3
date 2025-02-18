@extends('adminlte::page')

@section('title', 'Calendar')

@section('content_header')
    <h1>Event Calendar</h1>
@stop

@section('content')
    <div id="calendar"></div>

    <!-- Modal -->
    <div class="modal fade" id="scheduleAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="scheduleAppointmentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scheduleAppointmentModalLabel">Schedule Appointment</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('medical_visit.store') }}" method="POST" id="appointmentForm">
                        @csrf
                        <input type="hidden" name="appointment_id" id="appointment_id">
                        <div class="form-group">
                        @php
                                $patients = \App\Models\Patient::where('user_unique_id', auth()->user()->id)->get();
                            @endphp
                            <label for="patient_id">Patient</label>
                            <select name="patient_id" id="patient_id" class="form-control custom-select">
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" data-unique-id="{{ $patient->unique_id }}">{{ $patient->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="visit_date">Visit Date</label>
                            <input type="text" name="visit_date" id="visit_date" class="form-control datetimepicker" value="{{ old('visit_date') }}">
                        </div>
                        <div class="form-group">
                            <label for="doctor_id">Doctor</label>
                            <select name="doctor_id" id="doctor_id" class="form-control" required>
                                <!-- Options will be populated by JavaScript -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nurse_id">Nurse</label>
                            <select name="nurse_id" id="nurse_id" class="form-control" required>
                                <!-- Options will be populated by JavaScript -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="treatment_name">Treatment Name</label>
                            <input type="text" name="treatment_name" id="treatment_name" class="form-control" value="{{ old('treatment_name') }}">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link href='/vendor/fullcalendar/main.min.css' rel='stylesheet' />
    <style>
        #calendar {
            max-width: 1100px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
@stop

@section('js')
    <script src='/vendor/fullcalendar/main.min.js' defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('FullCalendar script loaded:', typeof FullCalendar !== 'undefined');
            var calendarEl = document.getElementById('calendar');

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                editable: true,
                events: @json($events).map(event => {
                    return {
                        ...event,
                        backgroundColor: event.status === 'Approved' ? 'green' : 'yellow',
                        borderColor: event.status === 'Approved' ? 'green' : 'yellow'
                    };
                }),

                dateClick: function(info) {
                    document.getElementById('visit_date').value = info.dateStr;
                    document.getElementById('appointment_id').value = '';
                    $('#scheduleAppointmentModal').modal('show');
                },
                eventClick: function(info) {
                    var event = info.event;
                    document.getElementById('appointment_id').value = event.id;
                    document.getElementById('visit_date').value = event.start.toISOString().slice(0, 16);
                    document.getElementById('patient_id').value = event.extendedProps.patient_id;
                    document.getElementById('doctor_id').value = event.extendedProps.doctor_id;
                    document.getElementById('nurse_id').value = event.extendedProps.nurse_id;
                    document.getElementById('treatment_name').value = event.extendedProps.treatment_name;
                    $('#scheduleAppointmentModal').modal('show');
                },
                eventDrop: function(info) {
                    var event = info.event;
                    var appointmentId = event.id;
                    var newDate = event.start.toISOString().slice(0, 16);

                    fetch(`/api/medical_visit/${appointmentId}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ visit_date: newDate })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Appointment rescheduled successfully');
                        } else {
                            alert('Failed to reschedule appointment');
                            info.revert();
                        }
                    })
                    .catch(error => {
                        console.error('Error rescheduling appointment:', error);
                        info.revert();
                    });
                }
            });

            // Debugging: Log the events data
            console.log('Calendar Events:', @json($events));

            calendar.render();
        });

        document.getElementById('patient_id').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var uniqueId = selectedOption.getAttribute('data-unique-id');
            document.getElementById('unique_id').value = uniqueId;
        });

        document.addEventListener('DOMContentLoaded', function() {
            fetchUsersWithRole('doctor', 'doctor_id');
            fetchUsersWithRole('nurse', 'nurse_id');

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

            flatpickr('.datetimepicker', {
                enableTime: true,
                dateFormat: 'Y-m-d H:i'
            });
        });
    </script>
@stop
