@extends('adminlte::page')

@section('title', 'Calendar')

@section('content_header')
    <h1>Event Calendar</h1>
@stop

@section('content')
    <div id="external-events">
        <p>
            <strong>Draggable Visits</strong>
        </p>
        <div class='fc-event' style='background-color: #ff5733;'>New Visit</div>
        <div class='fc-event' style='background-color: #33ff57;'>Emergency visit</div>
        <div class='fc-event' style='background-color: #3357ff;'>Completed Visit</div>
        <div class='fc-event' style='background-color: #ff33a6;'>Canceled Visit</div>
        <div class='fc-event' style='background-color: #a633ff;'>Rescheduled Visit</div>
    </div>
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
        #external-events {
            padding: 10px;
            width: 200px;
            height: auto;
            background: #f0f0f0;
            border: 1px solid #ccc;
            text-align: left;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .fc-event {
            margin: 10px 0;
            padding: 5px;
            cursor: pointer;
            border-radius: 3px;
            color: #fff;
            font-weight: bold;
            text-align: center;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
    </style>
@stop

@section('js')
    <script src='/vendor/fullcalendar/main.min.js' defer></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('FullCalendar script loaded:', typeof FullCalendar !== 'undefined');
            var calendarEl = document.getElementById('calendar');
            var containerEl = document.getElementById('external-events');

            new FullCalendar.Draggable(containerEl, {
                itemSelector: '.fc-event',
                eventData: function(eventEl) {
                    return {
                        title: eventEl.innerText.trim(),
                        backgroundColor: eventEl.style.backgroundColor
                    };
                }
            });

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                editable: true,
                droppable: true,
                events: [
                    {
                        title: 'Meeting',
                        start: '2025-02-15',
                        backgroundColor: '#ff5733'
                    },
                    {
                        title: 'Conference',
                        start: '2025-02-18',
                        end: '2025-02-20',
                        backgroundColor: '#33ff57'
                    }
                ]
            });

            calendar.render();
        });
    </script>
@stop
