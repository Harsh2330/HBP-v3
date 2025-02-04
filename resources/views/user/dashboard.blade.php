@extends('layouts.app')

@section('content')
<div class="container">
    <h1>User Dashboard</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Patients</h5>
                    <p class="card-text">{{ $totalPatients }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Medical Visits</h5>
                    <p class="card-text">{{ $totalMedicalVisits }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Select Patient</h5>
                    <form method="GET" action="{{ route('user.dashboard') }}">
                        <div class="form-group">
                            <select name="patient_id" class="form-control" onchange="this.form.submit()">
                                @foreach($patients as $patient)
                                    <option value="{{ $patient->id }}" {{ $selectedPatientId == $patient->id ? 'selected' : '' }}>
                                        {{ $patient->full_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if($selectedPatientId && !empty($vitalsData))
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Vitals Graph for Patient: {{ $patients->find($selectedPatientId)->full_name }}</h5>
                    <canvas id="vitalsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if($selectedPatientId && !empty($vitalsData))
    var ctx = document.getElementById('vitalsChart').getContext('2d');
    var vitalsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($vitalsData['dates']) !!},
            datasets: [{
                label: 'Blood Pressure',
                data: {!! json_encode($vitalsData['bloodPressure']) !!},
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'Heart Rate',
                data: {!! json_encode($vitalsData['heartRate']) !!},
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }, {
                label: 'Temperature',
                data: {!! json_encode($vitalsData['temperature']) !!},
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    @endif
</script>
@endsection
