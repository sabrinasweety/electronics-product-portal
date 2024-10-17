@extends('frontend.master')

@section('title', $product->name) <!-- Set the title -->

@section('content') <!-- Define the content section -->
@if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    <div class="container">
        
        <div class="row">
            <div class="col-md-6">
                <div class="product-img" style="text-align: center;">
                    <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 400px; object-fit: cover; border-radius: 8px;">
                </div>
            </div>
            <div class="col-md-6">
                <h1>{{ $product->name }}</h1>
                <p style="color: #666; font-size: 16px;">{{ $product->description }}</p>
                <h3>Price: ${{ $product->price }}</h3>
                <p style="font-size: 14px; color: #999;">Quantity: {{ $product->quantity }}</p>
                
            <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-primary">Add to Cart</button>
            </form>
        </div>
        </div>
    </div>
@endsection <!-- End of content section -->
