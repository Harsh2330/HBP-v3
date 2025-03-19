@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4" style="color: #4e73df; font-weight: bold;">Admin Dashboard</h1>
    <div class="row">
        <div class="col-md-4">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa; border-left: 5px solid #4e73df;">
                    <h5 class="card-title" style="color: #4e73df; font-weight: bold;">Total Users</h5>
                    <p class="card-text" style="font-size: 1.2em;">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa; border-left: 5px solid #1cc88a;">
                    <h5 class="card-title" style="color: #1cc88a; font-weight: bold;">Total Doctors</h5>
                    <p class="card-text" style="font-size: 1.2em;">{{ $totalDoctors }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa; border-left: 5px solid #f6c23e;">
                    <h5 class="card-title" style="color: #f6c23e; font-weight: bold;">Total Nurses</h5>
                    <p class="card-text" style="font-size: 1.2em;">{{ $totalNurses }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa; border-left: 5px solid #e74a3b;">
                    <h5 class="card-title" style="color: #e74a3b; font-weight: bold;">Total Administrators</h5>
                    <p class="card-text" style="font-size: 1.2em;">{{ $totalAdministrators }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa; border-left: 5px solid #36b9cc;">
                    <h5 class="card-title" style="color: #36b9cc; font-weight: bold;">Total Patients</h5>
                    <p class="card-text" style="font-size: 1.2em;">{{ $totalPatients }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa; border-left: 5px solid #6f42c1;">
                    <h5 class="card-title" style="color: #6f42c1; font-weight: bold;">Total Medical Visits</h5>
                    <p class="card-text" style="font-size: 1.2em;">{{ $totalMedicalVisits }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa;">
                    <h5 class="card-title" style="color: #4e73df; font-weight: bold;">Data Overview</h5>
                    <canvas id="dataOverviewChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa; border-left: 5px solid #4e73df;">
                    <h5 class="card-title" style="color: #4e73df; font-weight: bold;">Recent Activities</h5>
                    <input type="text" id="searchLogs" class="form-control mb-3" placeholder="Search activities...">
                    <ul class="list-group" id="auditLogList">
                        @foreach($auditLogs as $log)
                            <li class="list-group-item">
                                <strong>{{ $log->user->name }}</strong> {{ $log->action }}: {{ $log->description }}
                                <span class="text-muted float-right">{{ $log->created_at->diffForHumans() }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa;">
                    <h5 class="card-title" style="color: #4e73df; font-weight: bold;">Role Distribution</h5>
                    <canvas id="roleDistributionChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa;">
                    <h5 class="card-title" style="color: #4e73df; font-weight: bold;">Medical Visits Over Time</h5>
                    <canvas id="medicalVisitsChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
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
    // Bar chart for data overview
    const ctxOverview = document.getElementById('dataOverviewChart').getContext('2d');
    const dataOverviewChart = new Chart(ctxOverview, {
        type: 'bar',
        data: {
            labels: ['Users', 'Doctors', 'Nurses', 'Administrators', 'Patients', 'Medical Visits'],
            datasets: [{
                label: 'Count',
                data: [
                    {{ $totalUsers }},
                    {{ $totalDoctors }},
                    {{ $totalNurses }},
                    {{ $totalAdministrators }},
                    {{ $totalPatients }},
                    {{ $totalMedicalVisits }}
                ],
                backgroundColor: [
                    '#4e73df',
                    '#1cc88a',
                    '#f6c23e',
                    '#e74a3b',
                    '#36b9cc',
                    '#6f42c1'
                ],
                borderColor: [
                    '#4e73df',
                    '#1cc88a',
                    '#f6c23e',
                    '#e74a3b',
                    '#36b9cc',
                    '#6f42c1'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.raw;
                        }
                    }
                }
            },
            scales: { y: { beginAtZero: true } }
        }
    });

    // Pie chart for role distribution
    const ctxRole = document.getElementById('roleDistributionChart').getContext('2d');
    const roleDistributionChart = new Chart(ctxRole, {
        type: 'pie',
        data: {
            labels: ['Doctors', 'Nurses', 'Administrators'],
            datasets: [{
                data: [
                    {{ $totalDoctors }},
                    {{ $totalNurses }},
                    {{ $totalAdministrators }}
                ],
                backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b'],
                borderColor: ['#1cc88a', '#f6c23e', '#e74a3b'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            }
        }
    });

    // Line chart for medical visits over time (dummy data for now)
    const ctxVisits = document.getElementById('medicalVisitsChart').getContext('2d');
    const medicalVisitsChart = new Chart(ctxVisits, {
        type: 'line',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'], // Replace with dynamic data
            datasets: [{
                label: 'Medical Visits',
                data: [10, 20, 15, 30, 25, 40], // Replace with dynamic data
                backgroundColor: 'rgba(54, 185, 204, 0.2)',
                borderColor: '#36b9cc',
                borderWidth: 2,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                x: { beginAtZero: true },
                y: { beginAtZero: true }
            }
        }
    });

    // Search functionality for recent activities
    document.getElementById('searchLogs').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        const logs = document.querySelectorAll('#auditLogList .list-group-item');
        logs.forEach(log => {
            log.style.display = log.textContent.toLowerCase().includes(query) ? '' : 'none';
        });
    });
</script>
@endsection
