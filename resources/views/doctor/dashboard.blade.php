@extends('layouts.app')
@section('content')
<div class="container">
    <h1 class="text-center mb-4" style="color: #4e73df; font-weight: bold;">Doctor Dashboard</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa; border-left: 5px solid #4e73df;">
                    <h5 class="card-title" style="color: #4e73df; font-weight: bold;">Visits Summary</h5>
                    <canvas id="VisitChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa; border-left: 5px solid #1cc88a;">
                    <h5 class="card-title" style="color: #1cc88a; font-weight: bold;">Gender Distribution</h5>
                    <canvas id="genderChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa; border-left: 5px solid #f6c23e;">
                    <h5 class="card-title" style="color: #f6c23e; font-weight: bold;">Today's Appointments</h5><br>
                    <ul class="list-group">
                        @foreach($todaysAppointments as $appointment)
                            <li class="list-group-item d-flex justify-content-between align-items-center hover-effect">
                                <span class="font-weight-bold">{{ $appointment->patient->full_name }}</span>
                                <span class="badge badge-primary badge-pill">{{ $appointment->visit_date }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa; border-left: 5px solid #6f42c1;">
                    <h5 class="card-title" style="color: #6f42c1; font-weight: bold;">Recent Activities</h5>
                    <ul class="list-group">
                        <li class="list-group-item hover-effect">Checked patient John Doe</li>
                        <li class="list-group-item hover-effect">Follow-up with Jane Smith</li>
                        <li class="list-group-item hover-effect">Dental appointment with Robert Brown</li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card shadow-lg transition-card">
                <div class="card-body" style="background-color: #f8f9fa; border-left: 5px solid #e74c3c;">
                    <h5 class="card-title" style="color: #e74c3c; font-weight: bold;">Prescriptions</h5>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Medicine</th>
                                <th>Dosage</th>
                                <th>Frequency</th>
                            </tr>
                        </thead>
                        <tbody id="prescriptions-list">
                            <tr>
                                <td>Kirtan</td>
                                <td>Paracetamol</td>
                                <td>500mg</td>
                                <td>3 times a day</td>
                            </tr>
                            <tr>
                                <td>Tarun</td>
                                <td>Churan</td>
                                <td>200mg</td>
                                <td>2 times a day</td>
                            </tr>
                            <tr>
                                <td>Viral</td>
                                <td>Dolo</td>
                                <td>500mg</td>
                                <td>4 times a day</td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- <button class="btn btn-success" onclick="addPrescription()">Add Prescription</button> -->
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
    .hover-effect:hover {
        background-color: #f1f1f1;
        cursor: pointer;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const visitData = @json($visitData);
        const ctx = document.getElementById("VisitChart").getContext("2d");
        new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: ["Pending", "Completed", "Cancelled"],
                datasets: [{
                    data: [visitData.pending, visitData.completed, visitData.cancelled],
                    backgroundColor: ["#3498DB", "#E67E22", "#2ECC71"]
                }]
            }
        });

        const genderData = @json($genderData);
        const genderCtx = document.getElementById("genderChart").getContext("2d");
        new Chart(genderCtx, {
            type: "bar",
            data: {
                labels: ["Male", "Female", "Other"],
                datasets: [{
                    label: "Number of Patients",
                    data: [genderData.male, genderData.female, genderData.other],
                    backgroundColor: ["#3498DB", "#E74C3C", "#9B59B6"]
                }],
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            }
        });
    });

    function addPrescription() {
        const prescriptionsList = document.getElementById('prescriptions-list');
        const newRow = document.createElement('tr');
        newRow.innerHTML = `
            <td>New Patient</td>
            <td>New Medicine</td>
            <td>New Dosage</td>
            <td>New Frequency</td>
        `;
        prescriptionsList.appendChild(newRow);
    }

</script>
@endsection