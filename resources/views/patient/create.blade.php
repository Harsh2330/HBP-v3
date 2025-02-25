@extends('layouts.app')

@section('content')
<div class="content">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Patient</h1>
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
                            <form id="patientForm" action="{{ route('admin.patient.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="Full_name">Full Name</label>
                                    <input type="text" name="Full_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                

                                <div class="form-group">
                                    <label for="date_of_birth">Date of Birth</label>
                                    <input type="date" name="date_of_birth" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="age_category">Age Category</label>
                                    <select name="age_category" id="age_category" class="form-control" required>
                                        <option value="0-9">0-9</option>
                                        <option value="10-19">10-19</option>
                                        <option value="20-29">20-29</option>
                                        <option value="30-39">30-39</option>
                                        <option value="40-49">40-49</option>
                                        <option value="50-59">50-59</option>
                                        <option value="60-69">60-69</option>
                                        <option value="70-79">70-79</option>
                                        <option value="80+">80+</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Phone Number</label>
                                    <input type="number" name="phone_number" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="full_address">Full Address</label>
                                    <textarea name="full_address" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="religion">Religion</label>
                                    <select name="religion" class="form-control" required>
                                        <option value="Hindu">Hindu</option>
                                        <option value="Maksad">Maksad</option>
                                        <option value="Chamar">Chamar</option>
                                    </select>                                </div>
                                <div class="form-group">
                                    <label for="economic_status">Economic Status</label>
                                    <select name="economic_status" class="form-control" required>
                                        <option value="Poor">Poor</option>
                                        <option value="Lower Middle">Lower Middle</option>
                                        <!-- Add other economic statuses as needed -->
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="bpl_card">BPL Card</label>
                                    <input type="checkbox" name="bpl_card" id="bpl_card" value="1">
                                </div>
                                <div class="form-group" id="bpl_card_number_group" style="display: none;">
                                    <label for="bpl_card_number">BPL Card Number</label>
                                    <input type="number" name="bpl_card_number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="ayushman_card">Ayushman Card</label>
                                    <input type="checkbox" name="ayushman_card" id="ayushman_card" value="1">
                                </div>
                                <div class="form-group" id="ayushman_card_number_group" style="display: none;">
                                    <label for="ayushman_card_number">Ayushman Card Number</label>
                                    <input type="number" name="ayushman_card_number" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="emergency_contact_name">Emergency Contact Name</label>
                                    <input type="text" name="emergency_contact_name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="emergency_contact_phone">Emergency Contact Phone</label>
                                    <input type="text" name="emergency_contact_phone" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="emergency_contact_relationship">Emergency Contact Relationship</label>
                                    <select name="emergency_contact_relationship" class="form-control" required>
                                        <option value="Son">Son</option>
                                        <option value="Daughter">Daughter</option>
                                        <!-- Add other relationships as needed -->
                                    </select>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" >
                                </div> -->
                                <input type="hidden" name="full_name" id="full_name">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

<script>
    document.getElementById('patientForm').addEventListener('submit', function() {
        var fullName = document.querySelector('input[name="Full_name"]').value;
        document.getElementById('full_name').value = fullName;
    });

    document.addEventListener('DOMContentLoaded', function() {
        flatpickr('input[name="date_of_birth"]', {
            dateFormat: 'Y-m-d'
        });

        document.querySelector('input[name="date_of_birth"]').addEventListener('change', function() {
            var dob = new Date(this.value);
            var age = new Date().getFullYear() - dob.getFullYear();
            var ageCategory = '';

            if (age >= 0 && age <= 9) {
                ageCategory = '0-9';
            } else if (age >= 10 && age <= 19) {
                ageCategory = '10-19';
            } else if (age >= 20 && age <= 29) {
                ageCategory = '20-29';
            } else if (age >= 30 && age <= 39) {
                ageCategory = '30-39';
            } else if (age >= 40 && age <= 49) {
                ageCategory = '40-49';
            } else if (age >= 50 && age <= 59) {
                ageCategory = '50-59';
            } else if (age >= 60 && age <= 69) {
                ageCategory = '60-69';
            } else if (age >= 70 && age <= 79) {
                ageCategory = '70-79';
            } else {
                ageCategory = '80+'; // Add more categories as needed
            }

            document.getElementById('age_category').value = ageCategory;
        });

        document.getElementById('bpl_card').addEventListener('change', function() {
            var bplCardNumberGroup = document.getElementById('bpl_card_number_group');
            if (this.checked) {
                bplCardNumberGroup.style.display = 'block';
            } else {
                bplCardNumberGroup.style.display = 'none';
            }
        });

        document.getElementById('ayushman_card').addEventListener('change', function() {
            var ayushmanCardNumberGroup = document.getElementById('ayushman_card_number_group');
            if (this.checked) {
                ayushmanCardNumberGroup.style.display = 'block';
            } else {
                ayushmanCardNumberGroup.style.display = 'none';
            }
        });
    });
</script>
@endsection