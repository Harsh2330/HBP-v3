@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4" style="color: #4e73df; font-weight: bold;">Medical Visits</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg transition-card">
                <div class="card-header" style="background-color: #17a2b8; color: white;">
                    <h3 class="card-title">Medical Visits List</h3>
                </div>
                <div class="card-body">
                    @if($medicalVisits)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th style="font-size: 1.1em;">Patient Unique ID</th>
                                <th style="font-size: 1.1em;">Patient Name</th>
                                <th style="font-size: 1.1em;">Visit Date</th>
                                <th style="font-size: 1.1em;">Doctor</th>
                                <th style="font-size: 1.1em;">Nurse</th>
                                <th style="font-size: 1.1em;">Diagnosis</th>
                                <th style="font-size: 1.1em;">Medical Status</th>
                                <th style="font-size: 1.1em;">Actions</th>
                                <th style="font-size: 1.1em;">Admin Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medicalVisits as $visit)
                            <tr>
                                <td style="padding: 10px;">{{ $visit->patient->unique_id }}</td>
                                <td style="padding: 10px;">{{ $visit->patient->first_name }} {{ $visit->patient->middle_name}} {{ $visit->patient->last_name}}</td>
                                <td style="padding: 10px;">{{ $visit->visit_date }}</td>
                                <td style="padding: 10px;">{{ $visit->doctor_name }}</td>
                                <td style="padding: 10px;">{{ $visit->nurse_name }}</td>
                                <td style="padding: 10px;">{{ $visit->simplified_diagnosis }}</td>
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
                                <td style="padding: 10px;">
                                    @if(Auth::user()->isAdmin())
                                        <form action="{{ route('medical_visit.approve', $visit->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success">Approve</button>
                                        </form>
                                        <form action="{{ route('medical_visit.reject', $visit->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-warning">Reject</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="9">
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
