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
                events: [
                    {
                        title: 'Meeting',
                        start: '2025-02-15'
                    },
                    {
                        title: 'Conference',
                        start: '2025-02-18',
                        end: '2025-02-20'
                    }
                ]
            });

            calendar.render();
        });
    </script>
@stop
