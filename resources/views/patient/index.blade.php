@extends('layouts.app')

@section('content')
<div class="content p-6 bg-gray-100 min-h-screen">
    <section class="mb-6">
        <div class="container mx-auto">
            <div class="flex justify-between items-center bg-white p-4 rounded shadow">
                <h1 class="text-2xl font-bold text-gray-700">My Patients</h1>
                <a href="{{ route('admin.patient.create') }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">Add Patient</a>
            </div>
        </div>
    </section>

    <section>
        <div class="container mx-auto">
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-lg font-semibold text-gray-600 mb-4">Search Patient</h2>
                <form action="{{ route('admin.patient.index') }}" method="GET" class="flex gap-2">
                    <input type="text" name="search" class="p-2 border rounded w-full" placeholder="Search by Patient name">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Search</button>
                </form>
            </div>
        </div>
    </section>

    <section class="mt-6">
        <div class="container mx-auto">
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-lg font-semibold text-gray-600 mb-4">Users List</h2>
                <div class="grid md:grid-cols-3 gap-6">
                    @foreach($patients as $patient)
                                                
                        @if(Auth::user()->hasRole('Admin') || Auth::user()->id == $patient->user_unique_id)
                            <div class="bg-white p-4 rounded-lg shadow border border-blue-300">
                                <h3 class="text-lg font-bold text-gray-700">{{ $patient->full_name }}</h3>
                                <p class="text-gray-600"><strong>Email:</strong> {{ $patient->email }}</p>
                                <div class="mt-4 flex gap-2">
                                    <a href="{{ route('admin.patient.show', $patient->id) }}" class="px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">View</a>
                                    <form action="{{ route('admin.patient.destroy', $patient->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $patients->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
