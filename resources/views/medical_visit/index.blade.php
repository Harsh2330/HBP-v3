@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center mb-4 text-primary font-weight-bold" style="font-size: 2.5rem;">Medical Visits</h1>
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-lg transition-card">
                <div class="card-header bg-info text-white">
                    <h3 class="card-title" style="font-size: 1.8rem;">Medical Visits List</h3>
                    <form action="{{ route('medical_visit.index') }}" method="GET" class="form-inline float-right">
                        <input type="text" name="search" class="form-control mr-2" placeholder="Search by Patient ID or Name" style="font-size: 1.1rem;">
                        <button type="submit" class="btn btn-light" style="font-size: 1.1rem;">Search</button>
                    </form>
                </div>
                <div class="card-body">
                    @if($medicalVisits)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="font-weight-bold" style="font-size: 1.2rem;">Patient Unique ID</th>
                                <th class="font-weight-bold" style="font-size: 1.2rem;">Patient Name</th>
                                <th class="font-weight-bold" style="font-size: 1.2rem;">Visit Date</th>
                                <th class="font-weight-bold" style="font-size: 1.2rem;">Doctor</th>
                                <th class="font-weight-bold" style="font-size: 1.2rem;">Nurse</th>
                                <th class="font-weight-bold" style="font-size: 1.2rem;">Appointment Status</th>
                                <th class="font-weight-bold" style="font-size: 1.2rem;">Medical Status</th>
                                <th class="font-weight-bold" style="font-size: 1.2rem;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($medicalVisits as $visit)
                            <tr>
                                <td class="p-2" style="font-size: 1.1rem;">{{ $visit->patient->unique_id }}</td>
                                <td class="p-2" style="font-size: 1.1rem;">{{ $visit->patient->name }}</td>
                                <td class="p-2" style="font-size: 1.1rem;">{{ $visit->visit_date }}</td>
                                <td class="p-2" style="font-size: 1.1rem;">{{ $visit->doctor->name }}</td>
                                <td class="p-2" style="font-size: 1.1rem;">{{ $visit->nurse->name }}</td>
                                <td class="p-2" style="font-size: 1.1rem;">{{ $visit->is_approved }}</td>
                                <td class="p-2" style="font-size: 1.1rem;">
                                    <form action="{{ route('medical_visit.update_status', $visit->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('PATCH')
                                        <select name="medical_status" onchange="this.form.submit()" class="form-control" style="font-size: 1.1rem;">
                                            <option value="Pending" {{ $visit->medical_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Completed" {{ $visit->medical_status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="Cancelled" {{ $visit->medical_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="p-2" style="font-size: 1.1rem;">
                                    <a href="{{ route('medical_visit.show', $visit->id) }}" class="btn btn-info" style="font-size: 1.1rem;">View Visit</a>
                                    <a href="{{ route('medical_visit.edit', $visit->id) }}" class="btn btn-primary" style="font-size: 1.1rem;">Edit Visit</a>
                                    <form action="{{ route('medical_visit.destroy', $visit->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" style="font-size: 1.1rem;" onclick="return confirm('Are you sure you want to delete this visit?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            <tr>
                                <td colspan="8">
                                    <a href="{{ route('medical_visit.create') }}" class="btn btn-success" style="font-size: 1.1rem;">Add New Visit</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{ $medicalVisits->links() }}
                    @else
                    <p style="font-size: 1.1rem;">No medical visits available.</p>
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
    .text-primary {
        color: #4e73df !important;
    }
    .font-weight-bold {
        font-weight: bold !important;
    }
    .bg-info {
        background-color: #17a2b8 !important;
    }
    .text-white {
        color: white !important;
    }
    .p-2 {
        padding: 10px !important;
    }
</style>
@endsection
