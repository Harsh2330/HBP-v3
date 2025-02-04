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
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Unique ID</th>
                                        <th>Phone Number</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($patients as $patient)
                                    <tr>
                                        <td>{{ $patient->id }}</td>
                                        <td>{{ $patient->full_name }}</td>
                                        <td>{{ $patient->email }}</td>
                                        <td>{{ $patient->unique_id }}</td>
                                        <td>{{ $patient->phone_number }}</td>
                                        <td>
                                            <a href="{{ route('admin.patient.show', $patient->id) }}" class="btn btn-info">View</a>
                                            <a href="{{ route('admin.patient.edit', $patient->id) }}" class="btn btn-warning">Edit</a>
                                            <form action="{{ route('admin.patient.destroy', $patient->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
