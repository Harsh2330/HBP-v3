@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Dashboard') }}</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="text-center">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="img-fluid mb-4 animated-logo mx-auto">
        </div>

        <p class="welcome-text text-center">{{ __('Welcome, ') }}{{ Auth::user()->name }}{{ __('! You are logged in!') }}</p>
    </div>
</div>

<style>
    .animated-logo {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .welcome-text {
        font-size: 1.5rem;
        font-weight: bold;
        color: #2c3e50;
        text-align: center; /* Center align text */
    }

    .card {
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #3498db;
        color: white;
        font-size: 1.25rem;
        text-align: center;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }

    .card-body {
        background-color: #ecf0f1;
        text-align: center; /* Center align content */
    }
</style>
@endsection
