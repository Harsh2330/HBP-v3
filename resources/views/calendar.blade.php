@extends('adminlte::page')

@section('title', 'Calendar')

@section('content_header')
    <h1>Event Calendar</h1>
@stop

@section('content')
    <div id="calendar"></div>
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
                editable: true,
                events: @json($events)
            });

            // Debugging: Log the events data
            console.log('Calendar Events:', @json($events));

            calendar.render();
        });
    </script>
@stop
