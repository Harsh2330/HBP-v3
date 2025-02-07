@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Role Management</h2>
        @can('role-create')
            <a class="btn btn-success btn-sm mb-2" href="{{ route('roles.create') }}"><i class="fa fa-plus"></i> Create New Role</a>
        @endcan
    </div>

    @session('success')
        <div class="alert alert-success" role="alert"> 
            {{ $value }}
        </div>
    @endsession

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700" width="100px">No</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700">Name</th>
                <th class="py-2 px-4 text-left text-sm font-medium text-gray-700" width="280px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($roles as $key => $role)
            <tr class="border-b">
                <td class="py-2 px-4">{{ ++$i }}</td>
                <td class="py-2 px-4">{{ $role->name }}</td>
                <td class="py-2 px-4">
                    <a class="btn btn-info btn-sm" href="{{ route('roles.show',$role->id) }}"><i class="fa-solid fa-list"></i> Show</a>
                    @can('role-edit')
                        <a class="btn btn-primary btn-sm" href="{{ route('roles.edit',$role->id) }}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                    @endcan

                    @can('role-delete')
                    <form method="POST" action="{{ route('roles.destroy', $role->id) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i> Delete</button>
                    </form>
                    @endcan
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {!! $roles->links('pagination::bootstrap-5') !!}
</div>
@endsection