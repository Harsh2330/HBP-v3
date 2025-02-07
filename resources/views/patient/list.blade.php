@extends('layouts.app')

@section('content')
<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Patient List</h1>
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
                            <h3 class="card-title">Search Pending Users</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.patient.list') }}" method="GET" class="form-inline">
                                <div class="form-group mb-2">
                                    <input type="text" name="search" class="form-control" placeholder="Search by User name">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2 ml-2">Search</button>
                                <a href="{{ route('admin.patient.create') }}" class="btn btn-primary mb-2 ml-auto">Add Patient</a>
                            </form>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Patients</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach($patients as $patient)
                                <div class="col-md-4">
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $patient->full_name }}</h5>
                                            <p class="card-text"><strong>Email:</strong> {{ $patient->email }}</p>
                                            <p class="card-text"><strong>Unique ID:</strong> {{ $patient->unique_id }}</p>
                                            <p class="card-text"><strong>Phone Number:</strong> {{ $patient->phone_number }}</p>
                                            <a href="{{ route('admin.patient.show', $patient->id) }}" class="btn btn-info">View</a>
                                            <a href="{{ route('admin.patient.edit', $patient->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('admin.patient.destroy', $patient->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="mt-3">
                                {{ $patients->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
@endsection
