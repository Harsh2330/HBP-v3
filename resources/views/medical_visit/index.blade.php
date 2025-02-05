@extends('layouts.app')

@section('content')
<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 style="font-family: Arial, sans-serif;">Medical Visits</h1>
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
                                        <th style="font-size: 1.1em;">Doctor</th> <!-- Changed font size -->
                                        <th style="font-size: 1.1em;">Nurse</th> <!-- Changed font size -->
                                        <th style="font-size: 1.1em;">Appointment Status</th> <!-- Changed font size -->
                                        <th style="font-size: 1.1em;">Medical Status</th> <!-- Changed font size -->
                                        <th style="font-size: 1.1em;">Actions</th> <!-- Changed font size -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($medicalVisits as $visit)
                                    <tr>
                                        <td style="padding: 10px;">{{ $visit->patient->pat_unique_id }}</td> <!-- Added padding -->
                                        <td style="padding: 10px;">{{ $visit->patient->full_name }}</td> <!-- Added padding -->
                                        <!-- ...existing code... -->
                                        <td style="padding: 10px;">{{ $visit->visit_date }}</td> <!-- Added padding -->
                                        <td style="padding: 10px;">{{ $visit->doctor->name }}</td> <!-- Added padding -->
                                        <td style="padding: 10px;">{{ $visit->nurse->name}}</td> <!-- Added padding -->
                                        <!-- <td style="padding: 10px;">{{ $visit->simplified_diagnosis }}</td> -->
                                        <td style="padding: 10px;">{{ $visit->is_approved }}</td>
                                        
                                        <td style="padding: 10px;">
                                            <form action="{{ route('medical_visit.update_status', $visit->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <select name="medical_status" onchange="this.form.submit()" class="form-control">
                                                    <option value="Pending" {{ $visit->medical_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Completed" {{ $visit->medical_status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="Cancelled" {{ $visit->medical_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </form>
                                        </td> 
                                        
                                        <td style="padding: 10px;">
                                            <a href="{{ route('medical_visit.show', $visit->id) }}" class="btn btn-info">View Visit</a>
                                            <a href="{{ route('medical_visit.edit', $visit->id) }}" class="btn btn-primary">Edit Visit</a>
                                            <form action="{{ route('medical_visit.destroy', $visit->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this visit?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="8">
                                            <a href="{{ route('medical_visit.create') }}" class="btn btn-success">Add New Visit</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            {{ $medicalVisits->links() }}
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
