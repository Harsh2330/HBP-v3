@extends('layouts.app')

@section('content')
<div class="container mx-auto">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Create New Role</h2>
        <a class="btn btn-primary btn-sm mb-2" href="{{ route('roles.index') }}"><i class="fa fa-arrow-left"></i> Back</a>
    </div>

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('roles.store') }}">
        @csrf
        <div class="bg-white shadow-lg rounded-lg p-4">
            <div class="mb-4">
                <strong>Name:</strong>
                <input type="text" name="name" placeholder="Name" class="form-control">
            </div>
            <div class="mb-4">
                <strong>Permission:</strong>
                <br/>
                @foreach($permission as $value)
                    <label><input type="checkbox" name="permission[{{$value->id}}]" value="{{$value->id}}" class="name">
                    {{ $value->name }}</label>
                <br/>
                @endforeach
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-sm mb-3"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection