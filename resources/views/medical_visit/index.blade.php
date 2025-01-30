@extends('layouts.app')

@section('content')
<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Medical Visits</h1>
                    @if(Auth::check())
                        <span class="badge badge-primary">Logged in as: {{ Auth::user()->name }}</span>
                    @endif
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Medical Visits List</h3>
                        </div>
                        <div class="card-body">
                            @if($medicalVisits)
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Patient Unique ID</th>
                                        <th>Patient Name</th>
                                        <th>Visit Date</th>
                                        <th>Doctor</th>
                                        <th>Nurse</th>
                                        <th>Diagnosis</th>
                                        <th>Medical Status</th> <!-- New column added -->
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($medicalVisits as $visit)
                                    <tr>
                                        <td>{{ $visit->patient->unique_id }}</td>
                                        <td>{{ $visit->patient->first_name }} {{ $visit->patient->middle_name}} {{ $visit->patient->last_name}}</td>
                                        <td>{{ $visit->visit_date }}</td>
                                        <td>{{ $visit->doctor_name }}</td>
                                        <td>{{ $visit->nurse_name }}</td>
                                        <td>{{ $visit->simplified_diagnosis }}</td>
                                        <td>
                                            <form action="{{ route('medical_visit.update_status', $visit->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <select name="medical_status" onchange="this.form.submit()">
                                                    <option value="Pending" {{ $visit->medical_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="Completed" {{ $visit->medical_status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                                    <option value="Cancelled" {{ $visit->medical_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                                </select>
                                            </form>
                                        </td> <!-- Display medical status -->
                                        
                                        <td>
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
