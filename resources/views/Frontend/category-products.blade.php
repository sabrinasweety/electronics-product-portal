@extends('frontend.master') 
<!-- Extending the master layout -->


@section('title', $category->name . ' Collection') <!-- Set the title -->

@section('content') 
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

<!-- Define the content section -->
    <h1>{{ $category->name }} Collection</h1>
    
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4 col-xs-6">
                <div class="product" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; box-shadow: 0px 4px 8px rgba(0,0,0,0.1); border-radius: 10px;">
                    <div class="product-img" style="text-align: center;">
                        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 100%; height: 250px; object-fit: cover; border-radius: 8px;">
                    </div>
                    <div class="product-body" style="padding: 10px; text-align: center;">
                        <h3 class="product-name" style="font-size: 18px; font-weight: bold; margin-bottom: 10px;">{{ $product->name }}</h3>
                        <p class="product-description" style="color: #666; font-size: 14px; margin-bottom: 10px;">{{ $product->description }}</p>
                        <p class="product-price" style="font-size: 16px; color: #333; font-weight: bold;">Price: ${{ $product->price }}</p>
                        <p class="product-quantity" style="font-size: 14px; color: #999;">Quantity: {{ $product->quantity }}</p>
                        
                        <!-- Add View Product Button -->
                        <a href="{{ route('product.view', $product->id) }}" class="btn btn-info" style="background-color: #3498db; border: none; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">View Product</a>

                        <!-- Add to Cart Button -->
                        <!-- <a href="{{ route('cart.add', $product->id) }}" class="btn btn-primary" style="background-color: #5cb85c; border: none; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Add to Cart</a> -->
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" style="display: inline;">
                         @csrf
                        <button type="submit" class="btn btn-primary" style="background-color: #5cb85c; border: none; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Add to Cart</button>
                        </form>
                    
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection <!-- End of content section -->
