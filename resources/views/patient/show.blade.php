@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 py-10 px-4">
    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-3xl font-bold text-blue-600 text-center mb-6">Patient Details</h1>
        
        @if(isset($patient))
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Left Section -->
            <div class="bg-blue-50 p-5 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-blue-700 mb-4">Personal Information</h2>
                <p class="mt-2"><strong class="text-gray-800">Full Name:</strong> {{ $patient->full_name }}</p>
                <p class="mt-2"><strong class="text-gray-800">Gender:</strong> {{ $patient->gender }}</p>
                <p class="mt-2"><strong class="text-gray-800">Date of Birth:</strong> {{ $patient->date_of_birth }}</p>
                <p class="mt-2"><strong class="text-gray-800">Age Category:</strong> {{ $patient->age_category }}</p>
                <p class="mt-2"><strong class="text-gray-800">Phone Number:</strong> {{ $patient->phone_number }}</p>
                <p class="mt-2"><strong class="text-gray-800">Email:</strong> {{ $patient->email }}</p>
                <p class="mt-2"><strong class="text-gray-800">Full Address:</strong> {{ $patient->full_address }}</p>
                <p class="mt-2"><strong class="text-gray-800">Religion:</strong> {{ $patient->religion }}</p>
            </div>
            
            <!-- Right Section -->
            <div class="bg-green-50 p-5 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-green-700 mb-4">Additional Information</h2>
                <p class="mt-2"><strong class="text-gray-800">Economic Status:</strong> {{ $patient->economic_status }}</p>
                <p class="mt-2"><strong class="text-gray-800">BPL Card Number:</strong> {{ $patient->bpl_card_number }}</p>
                <p class="mt-2"><strong class="text-gray-800">Ayushman Card:</strong> {{ $patient->ayushman_card ? 'Yes' : 'No' }}</p>
                <p class="mt-2"><strong class="text-gray-800">Emergency Contact Name:</strong> {{ $patient->emergency_contact_name }}</p>
                <p class="mt-2"><strong class="text-gray-800">Emergency Contact Phone:</strong> {{ $patient->emergency_contact_phone }}</p>
                <p class="mt-2"><strong class="text-gray-800">Emergency Contact Relationship:</strong> {{ $patient->emergency_contact_relationship }}</p>
                <!-- <p class="mt-2"><strong class="text-gray-800">Approval Status:</strong> <span class="font-semibold {{ $patient->is_approved ? 'text-green-600' : 'text-red-600' }}">{{ $patient->is_approved ? 'Approved' : 'Not Approved' }}</span></p> -->
            </div>
        </div>
        @else
        <p class="text-red-500 text-lg font-semibold text-center mt-6">Patient information is not available.</p>
        @endif
    </div>
</div>
@endsection
