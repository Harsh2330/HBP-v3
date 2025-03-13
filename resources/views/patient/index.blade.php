@extends('layouts.app')

@section('content')
<!-- Add DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">

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
                        <!-- DataTables will populate this section -->
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>

<!-- Add jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#patients-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('admin.patient.getData') }}',
            columns: [
                { data: 'full_name', name: 'full_name' },
                { data: 'email', name: 'email' },
                { data: 'actions', name: 'actions', orderable: false, searchable: false }
            ],
            "paging": true,     
            "searching": true,
            "ordering": true,
            "destroy": true,
            "dom": '<"top"lfB>rt<"bottom"ip><"clear">', // Add export buttons to "top"
            "buttons": [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            "renderer": "semanticUI"
        }).buttons().container().appendTo('#patients-table_wrapper .col-md-6:eq(0)');

        $('#patients-table_filter input')
            .attr('placeholder', 'Search Patients...')
            .css({
                'color': 'black',
                'font-weight': 'bold'
            });
    });
</script>
@endsection
