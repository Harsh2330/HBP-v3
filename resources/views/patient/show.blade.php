@extends('layouts.app')

@section('content')
<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Patient Details</h1>
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
                            <h3 class="card-title">Patient Information</h3>
                        </div>
                        <div class="card-body">
                            @if(isset($patient))
                            <table class="table table-bordered">
                                <tr>
                                    <th>Full Name</th>
                                    <td>{{ $patient->full_name }}</td>
                                </tr>
                                <tr>
                                    <th>Gender</th>
                                    <td>{{ $patient->gender }}</td>
                                </tr>
                                <tr>
                                    <th>Date of Birth</th>
                                    <td>{{ $patient->date_of_birth }}</td>
                                </tr>
                                <tr>
                                    <th>Age Category</th>
                                    <td>{{ $patient->age_category }}</td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td>{{ $patient->phone_number }}</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>{{ $patient->email }}</td>
                                </tr>
                                <tr>
                                    <th>Full Address</th>
                                    <td>{{ $patient->full_address }}</td>
                                </tr>
                                <tr>
                                    <th>Religion</th>
                                    <td>{{ $patient->religion }}</td>
                                </tr>
                                <tr>
                                    <th>Economic Status</th>
                                    <td>{{ $patient->economic_status }}</td>
                                </tr>
                                <tr>
                                    <th>BPL Card Number</th>
                                    <td>{{ $patient->bpl_card_number }}</td>
                                </tr>
                                <tr>
                                    <th>Ayushman Card</th>
                                    <td>{{ $patient->ayushman_card ? 'Yes' : 'No' }}</td>
                                </tr>
                                <tr>
                                    <th>Emergency Contact Name</th>
                                    <td>{{ $patient->emergency_contact_name }}</td>
                                </tr>
                                <tr>
                                    <th>Emergency Contact Phone</th>
                                    <td>{{ $patient->emergency_contact_phone }}</td>
                                </tr>
                                <tr>
                                    <th>Emergency Contact Relationship</th>
                                    <td>{{ $patient->emergency_contact_relationship }}</td>
                                </tr>
                                <tr>
                                    <th>Approval Status</th>
                                    <td>{{ $patient->is_approved ? 'Approved' : 'Not Approved' }}</td>
                                </tr>
                            </table>
                            @else
                            <p>Patient information is not available.</p>
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