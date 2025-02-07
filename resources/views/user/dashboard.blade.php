@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4" style="color: #4e73df; font-weight: bold;">User Dashboard</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa; border-left: 5px solid #4e73df;">
                    <h5 class="card-title" style="color: #4e73df; font-weight: bold;">Total Patients</h5>
                    <p class="card-text" style="font-size: 1.2em;">{{ $totalPatients }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa; border-left: 5px solid #1cc88a;">
                    <h5 class="card-title" style="color: #1cc88a; font-weight: bold;">Total Medical Visits</h5>
                    <p class="card-text" style="font-size: 1.2em;">{{ $totalMedicalVisits }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa; border-left: 5px solid #36b9cc;">
                    <h5 class="card-title" style="color: #36b9cc; font-weight: bold;">Select Patient</h5>
                    <form method="GET" action="{{ route('user.dashboard') }}">
                        <div class="form-group">
                            <select name="patient_id" class="form-control" onchange="this.form.submit()" style="font-size: 1.1em;">
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
            <div class="card shadow-lg transition-card">
                <div class="card-body">
                    <h5 class="card-title" style="color: #f6c23e; font-weight: bold;">Vitals Graph for Patient: {{ $patients->find($selectedPatientId)->full_name }}</h5>
                    <canvas id="vitalsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

<style>
    .transition-card {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    .transition-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if($selectedPatientId && !empty($vitalsData))
    var ctx = document.getElementById('vitalsChart').getContext('2d');
    var gradientBP = ctx.createLinearGradient(0, 0, 0, 400);
    gradientBP.addColorStop(0, 'rgba(255, 99, 132, 0.2)');
    gradientBP.addColorStop(1, 'rgba(255, 99, 132, 0)');

    var gradientHR = ctx.createLinearGradient(0, 0, 0, 400);
    gradientHR.addColorStop(0, 'rgba(54, 162, 235, 0.2)');
    gradientHR.addColorStop(1, 'rgba(54, 162, 235, 0)');

    var gradientTemp = ctx.createLinearGradient(0, 0, 0, 400);
    gradientTemp.addColorStop(0, 'rgba(75, 192, 192, 0.2)');
    gradientTemp.addColorStop(1, 'rgba(75, 192, 192, 0)');

    var vitalsChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($vitalsData['dates']) !!},
            datasets: [{
                label: 'Blood Pressure',
                data: {!! json_encode($vitalsData['bloodPressure']) !!},
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: gradientBP,
                borderWidth: 2,
                pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(255, 99, 132, 1)',
                tension: 0.4,
                fill: true
            }, {
                label: 'Heart Rate',
                data: {!! json_encode($vitalsData['heartRate']) !!},
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: gradientHR,
                borderWidth: 2,
                pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(54, 162, 235, 1)',
                tension: 0.4,
                fill: true
            }, {
                label: 'Temperature',
                data: {!! json_encode($vitalsData['temperature']) !!},
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: gradientTemp,
                borderWidth: 2,
                pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(75, 192, 192, 1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(200, 200, 200, 0.2)'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(200, 200, 200, 0.2)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: 'rgb(255, 99, 132)',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                }
            }
        }
    });
    @endif
</script>
@endsection
