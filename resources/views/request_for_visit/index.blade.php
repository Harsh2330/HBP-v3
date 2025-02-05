@extends('layouts.app')

@section('content')
<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="font-family: Arial, sans-serif;">Requested Medical Visits</h1>
                </div>
                <div class="col-sm-6 text-right">
                    @if(Auth::check())
                        <span class="badge badge-primary slide-in" style="font-size: 1.2em;">Logged in as : {{ Auth::user()->name }}</span>
                    @endif
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <style>
        @keyframes slideIn {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(0);
            }
        }

        .slide-in {
            animation: slideIn 2s;
        }
    </style>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-lg"> <!-- Added shadow class -->
                        <div class="card-header" style="background-color: #17a2b8; color: white;"> <!-- Changed background color -->
                            <h3 class="card-title">Medical Visits List</h3>
                        </div>
                        <div class="card-body">
                            @if($medicalVisits)
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="font-size: 1.1em;">Patient Unique ID</th> <!-- Changed font size -->
                                        <th style="font-size: 1.1em;">Patient Name</th> <!-- Changed font size -->
                                        <th style="font-size: 1.1em;">Visit Date</th> <!-- Changed font size -->
                                        <th style="font-size: 1.1em;">Action</th> <!-- Added new column for action -->
                                        <th style="font-size: 1.1em;">Approval Status</th> <!-- Added new column for approval status -->
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $pendingVisits = $medicalVisits->filter(function($visit) {
                                        return $visit->is_approved == 'pending';
                                    });
                                    @endphp
                                    @foreach($pendingVisits as $visit)
                                    <tr>
                                        <td style="padding: 10px;">{{ $visit->patient->pat_unique_id }}</td> <!-- Added padding -->
                                        <td style="padding: 10px;">{{ $visit->patient->full_name }} {{ $visit->patient->middle_name}} {{ $visit->patient->last_name}}</td> <!-- Added padding -->
                                        <td style="padding: 10px;">{{ $visit->visit_date }}</td> <!-- Added padding -->
                                        <td style="padding: 10px;">
                                            <form action="{{ route('approve.visit', $visit->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="is_approved" value="Approved"> <!-- Changed value to "Approved" -->
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </form>
                                        </td> <!-- Added approve button -->
                                        <td style="padding: 10px;">
                                            {{ $visit->is_approved ? 'Pending' : 'Approved' }}
                                        </td> <!-- Display approval status -->
                                    
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p>No medical visits available.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
