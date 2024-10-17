<!-- resources/views/frontend/user/profile.blade.php -->

@extends('frontend.master')

@section('content')
<div class="container">
    <h2 class="mb-4">Profile</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">User Details</h5>
            <p><strong>Name:</strong> {{ auth()->user()->name }}</p>
            <p><strong>Email:</strong> {{ auth()->user()->email }}</p>
            <p><strong>Role:</strong> {{ auth()->user()->role }}</p>
        </div>
    </div>
</div>
@endsection
