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
@endsection
