<table>
    <thead>
        <tr>
            <th>Visit Date</th>
            <th>Doctor</th>
            <th>Complaint</th>
            <th>Diagnosis</th>
            <th>Medications</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach($userVisits as $visit)
        <tr>
            <td>{{ $visit->visit_date }}</td>
            <td>{{ $visit->doctor->name ?? 'N/A' }}</td>
            <td>{{ $visit->primary_complaint ?? 'N/A' }}</td>
            <td>{{ $visit->diagnosis ?? 'N/A' }}</td>
            <td>{{ $visit->medications_prescribed ?? 'N/A' }}</td>
            <td>{{ $visit->is_approved ?? 'N/A' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
