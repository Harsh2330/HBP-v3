<!DOCTYPE html>
<html>
<head>
    <title>Your Medical Visit is Scheduled</title>
</head>
<body>
    <h1>Your Medical Visit is Scheduled</h1>
    <p>Dear {{ $visit->patient->name }},</p>
    <p>Your medical visit has been scheduled as follows:</p>
    <ul>
        <li>Date: {{ $visit->visit_date }}</li>
        <li>Time: {{ $visit->time_slot }}</li>
        <li>Doctor: {{ $visit->doctor->name }}</li>
        <li>Nurse: {{ $visit->nurse->name ?? 'N/A' }}</li>
        <li>Appointment Type: {{ $visit->appointment_type }}</li>
        <li>Primary Complaint: {{ $visit->primary_complaint }}</li>
    </ul>
    <p>Thank you for choosing our services.</p>
</body>
</html>
