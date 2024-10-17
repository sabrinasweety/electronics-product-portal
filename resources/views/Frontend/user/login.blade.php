@extends('frontend.master')

@section('content')
    <div class="container-fluid d-flex justify-content-center align-items-center vh-100 vw-100 p-0" style="height:50vh; background-color: #f2f2f2; display: flex; justify-content: center; align-items: center;">
        <div class="card shadow" style="width: 100%; max-width: 450px; border-radius: 15px; background-color: #fff; padding: 20px; margin: auto;">
            <div class="card-body">
                <h2 class="text-center text-dark mb-4" style="font-size: 24px; font-weight: bold;">Login</h2>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.store') }}" style="margin-top: 20px;">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="text-dark" style="font-size: 18px; font-weight: bold;">Email:</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email" required style="outline: 1px solid #ccc; padding: 10px; border-radius: 5px;">
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-dark" style="font-size: 18px; font-weight: bold;">Password:</label>
                        <input type="password" class="form-control form-control-lg" id="password" name="password" required style="outline: 1px solid #ccc; padding: 10px; border-radius: 5px;">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #337ab7; color: #fff; padding: 10px 20px; border-radius: 5px;">Login</button>
                </form>

                <div class="text-center mt-3">
                    <p class="text-dark" style="font-size: 16px;">Don't have an account? <a href="{{ route('register') }}" class="text-primary" style="text-decoration: underline;">Register here</a></p>
                </div>
            </div>
        </div>
    </div>
@endsection