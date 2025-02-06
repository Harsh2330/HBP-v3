@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Show User</h2>
        <a class="btn btn-primary" href="{{ route('users.index') }}">Back</a>
    </div>

    <div class="bg-white shadow-lg rounded-lg p-4">
        <div class="mb-4">
            <strong>Name:</strong>
            <span>{{ $user->name }}</span>
        </div>
        <div class="mb-4">
            <strong>Email:</strong>
            <span>{{ $user->email }}</span>
        </div>
        <div class="mb-4">
            <strong>Phone Number:</strong>
            <span>{{ $user->phone_number }}</span>
        </div>
        <div class="mb-4">
            <strong>Roles:</strong>
            @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                    <span class="badge bg-success">{{ $v }}</span>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection