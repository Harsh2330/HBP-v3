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

    <section class="mt-6">
        <div class="container mx-auto">
            <div class="bg-white p-6 rounded shadow">
                <h2 class="text-lg font-semibold text-gray-600 mb-4">Patients List</h2>
                <table id="patients-table" class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 border-b border-gray-300">Full Name</th>
                            <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 border-b border-gray-300">Email</th>
                            <th class="py-2 px-4 text-left text-sm font-medium text-gray-700 border-b border-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($patients as $patient)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b border-gray-300">{{ $patient->full_name }}</td>
                            <td class="py-2 px-4 border-b border-gray-300">{{ $patient->email }}</td>
                            <td class="py-2 px-4 border-b border-gray-300">
                                <a href="{{ route('admin.patient.show', $patient->id) }}" class="px-3 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">View</a>
                                <form action="{{ route('admin.patient.destroy', $patient->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-2 bg-red-500 text-white rounded hover:bg-red-600">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#patients-table').DataTable({
            "paging": true,     
            "searching": true,
            "ordering": true,
            "destroy": true,
            "dom": '<"top"lf>rt<"bottom"ip><"clear">', // Move search bar to "top"
            "renderer": "semanticUI"
        });

        $('#patients-table_filter input')
            .attr('placeholder', 'Search Patients...')
            .css({
                'color': 'black',
                'font-weight': 'bold'
            });
    });
</script>
@endsection
