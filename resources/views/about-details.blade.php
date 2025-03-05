@extends('layouts.app')

@section('content')
<div class="container">
    <h1>About Dr. Aditya</h1>
    <div class="about-content">
        <div class="about-image">
            <img src="{{ asset('image/people_13997611[1].png') }}" alt="Dr. Aditya" class="img-fluid">
        </div>
        <div class="about-text">
            <h2>Dr. Aditya</h2>
            <p>Dr. Aditya is a renowned expert in his field with years of experience...</p>
            <p>More detailed information about Dr. Aditya...</p>
            <!-- Add more detailed content about Dr. Aditya here -->
        </div>
    </div>
</div>

<style>
    .about-content {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 20px;
    }

    .about-image img {
        max-width: 200px;
        border-radius: 50%;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .about-text {
        max-width: 600px;
    }

    .about-text h2 {
        font-size: 2rem;
        color: #2c3e50;
    }

    .about-text p {
        font-size: 1rem;
        color: #34495e;
    }
</style>
@endsection
