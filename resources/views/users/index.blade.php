@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Users Management</h2>
        <a class="btn btn-success mb-2" href="{{ route('users.create') }}"><i class="fa fa-plus"></i> Create New User</a>
    </div>

    @session('success')
        <div class="alert alert-success" role="alert"> 
            {{ $value }}
        </div>
    @endsession

    <table id="users-table" class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">No</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Name</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Email</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Phone Number</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Roles</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700" width="280px">Action</th>
            </tr>
        </thead>
        <tbody id="user-table-body">
            @foreach ($data as $key => $user)
            <tr class="border-b" id="user-row-{{ $user->id }}">
                <td class="py-2 px-4">{{ ++$i }}</td>
                <td class="py-2 px-4">{{ $user->name }}</td>
                <td class="py-2 px-4">{{ $user->email }}</td>
                <td class="py-2 px-4">{{ $user->phone_number }}</td>
                <td class="py-2 px-4">
                    @if(!empty($user->getRoleNames()))
                        @foreach($user->getRoleNames() as $v)
                            <span class="badge bg-success">{{ $v }}</span>
                        @endforeach
                    @endif
                </td>
                <td class="py-2 px-4">
                    <a class="btn btn-info btn-sm" href="{{ route('users.show',$user->id) }}"><i class="fas fa-list"></i> Show</a>
                    <a class="btn btn-primary btn-sm" href="{{ route('users.edit',$user->id) }}"><i class="	fas fa-pencil-alt"></i> Edit</a>
                    <button class="btn btn-danger btn-sm delete-user" data-id="{{ $user->id }}"><i class="fas fa-trash"></i> Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {!! $data->links('pagination::bootstrap-5') !!}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        $('#users-table').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "destroy": true
        });

        document.querySelectorAll('.delete-user').forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-id');
                fetch(`/users/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById(`user-row-${userId}`).remove();
                    } else {
                        alert('Error deleting user');
                    }
                });
            });
        });
    });
</script>
@endsection