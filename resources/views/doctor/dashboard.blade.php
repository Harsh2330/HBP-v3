@extends('layouts.app')

<!-- @section('content')
<div class="container">
    <h1>Doctor Dashboard</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Medical Visits</h5>
                    <p class="card-text">{{ $totalMedicalVisits }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            display: flex;
            background-color: #f4f6f9;
        }
        .dashboard {
            display: flex;
            width: 100%;
        }
        .sidebar {
            width: 250px;
            background: #34495e;
            color: white;
            padding: 20px;
            min-height: 100vh;
        }
        .sidebar h2 {
            text-align: center;
            font-weight: 300;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            padding: 10px 0;
        }
        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .sidebar ul li a:hover {
            background: #2c3e50;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        header {
            background:#CAA907;
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add shadow */
        }
        .cards {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 20px;
        }
        .card {
            background: white;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
        .chart-container, .calendar-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .chart-container {
            /* width: 50%; */
        }
        .chart-container canvas {
            width: 100% !important;
            height: auto !important;
            max-width: 400px; /* Set a maximum width */
        }
        .patient-detail {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.3);
            width: 300px;
            border-radius: 10px;
            text-align: center;
        }
        .patient-detail.active {
            display: block;
        }
        .appointment-list li {
            display: flex;
            justify-content: space-between;
            background: #ecf0f1;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .appointment-list li:hover {
            background: #bdc3c7;
        }
        .prescription-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .prescription-table th, .prescription-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .prescription-table th {
            background-color: #f9fafb; /* Change to sky blue */
            text-align: left;
        }
        .prescription-table tr:hover {
            background-color: #E0FFFF; /* Light cyan for hover effect */
        }
        @media (max-width: 768px) {
            .dashboard {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                text-align: center;
            }
            .cards {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        
        <main class="content">
            <header>
                <h1>Welcome, Doctor</h1>
                <input type="text" placeholder="Search..." style="width: 90%; padding: 10px; margin-top: 10px; border-radius: 5px; border: 1px solid #ccc;">
            </header>
            <section class="cards">
                <section class="card chart-container">
                    <h3><i class="fas fa-chart-pie"></i> Patients Summary</h3>
                    <canvas id="patientChart" style="width: 90%;"></canvas>
                </section>
                <section class="card chart-container">
                    <h3><i class="fas fa-venus-mars"></i> Gender Distribution</h3>
                    <canvas id="genderChart" style="width: 90%;"></canvas>
                </section>
                <section class="card">
                    <h3><i class="fas fa-calendar-day"></i> Today's Appointments</h3>
                    <ul class="appointment-list" id="appointments-list">
                        <li onclick="showPatientDetail('John Doe', 'Checkup', '10:00 AM')">
                            <span>John Doe - Checkup</span>
                            <span>10:00 AM</span>
                        </li>
                        <li onclick="showPatientDetail('Jane Smith', 'Follow-up', '11:00 AM')">
                            <span>Jane Smith - Follow-up</span>
                            <span>11:00 AM</span>
                        </li>
                        <li onclick="showPatientDetail('Robert Brown', 'Dental', '12:00 PM')">
                            <span>Robert Brown - Dental</span>
                            <span>12:00 PM</span>
                        </li>
                    </ul>
                </section>
                <section class="card">
                    <h3><i class="fas fa-user-md"></i> Doctor's Availability</h3>
                    <p>Dr. Smith: 9:00 AM - 5:00 PM</p>
                    <p>Dr. Johnson: 10:00 AM - 6:00 PM</p>
                </section>
                <section class="card">
                    <h3><i class="fas fa-notes-medical"></i> Recent Activities</h3>
                    <ul>
                        <li>Checked patient John Doe</li>
                        <li>Follow-up with Jane Smith</li>
                        <li>Dental appointment with Robert Brown</li>
                    </ul>
                </section>
                <section class="card">
                    <h3><i class="fas fa-prescription"></i> Prescriptions</h3>
                    <table class="prescription-table">
                        <thead>
                            <tr>
                                <th>Patient Name</th>
                                <th>Medicine</th>
                                <th>Dosage</th>
                                <th>Frequency</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>kirtan</td>
                                <td>paracetamol</td>
                                <td>500mg</td>
                                <td>3 times a day</td>
                            </tr>
                            <tr>
                                <td>tarun</td>
                                <td>churan</td>
                                <td>200mg</td>
                                <td>2 times a day</td>
                            </tr>
                            <tr>
                                <td>viral</td>
                                <td>dolo</td>
                                <td>500mg</td>
                                <td>4 times a day</td>
                            </tr>
                        </tbody>
                    </table>
                </section>
            </section>
        </main>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById("patientChart").getContext("2d");
            new Chart(ctx, {
                type: "doughnut",
                data: {
                    labels: ["New Patients", "Old Patients", "Total Patients"],
                    datasets: [{
                        data: [30, 50, 80],
                        backgroundColor: ["#3498DB", "#E67E22", "#2ECC71"]
                    }]
                }
            });

            const genderCtx = document.getElementById("genderChart").getContext("2d");
            new Chart(genderCtx, {
                type: "bar",
                data: {
                    labels: ["Male", "Female", "Other"],
                    datasets: [{
                        label: "Number of Patients",
                        data: [40, 35, 5],
                        backgroundColor: ["#3498DB", "#E74C3C", "#9B59B6"]
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</body>
</html>
