@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Show Role</h2>
        <a class="btn btn-primary" href="{{ route('roles.index') }}">Back</a>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-4">
        <div class="mb-4">
            <strong>Name:</strong>
            <span>{{ $role->name }}</span>
        </div>
        <div class="mb-4">
            <strong>Permissions:</strong>
            @if(!empty($rolePermissions))
                @foreach($rolePermissions as $v)
                    <span class="badge bg-success">{{ $v->name }}</span>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection