<!DOCTYPE html>
<html>
<head>
    <title>Your Visit Schedule</title>
</head>
<body>
    <h1>Your Visit Schedule</h1>
    <p>Dear {{ $visit->patient->full_name }},</p>
    <p>Your visit has been scheduled as follows:</p>
    <ul>
        <li>Date: {{ $visit->visit_date }}</li>
        <li>Time: {{ $visit->time_slot }}</li>
        <li>Doctor: {{ $visit->doctor->name }}</li>
        <li>Nurse: {{ $visit->nurse->name }}</li>
    </ul>
    <p>Thank you for choosing our services.</p>
</body>
</html>
