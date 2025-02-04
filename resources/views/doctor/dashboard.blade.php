@extends('layouts.app')

@section('content')
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
@endsection
