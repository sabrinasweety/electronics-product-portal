<!-- resources/views/admin/products/show-product.blade.php -->

@extends('admin.dashboard') <!-- Extend your layout -->

@section('content')
<div class="container">
    <h1>{{ $product->name }}</h1>
    
    <div>
        <strong>Description:</strong>
        <p>{{ $product->description }}</p>
    </div>
    
    <div>
        <strong>Price:</strong>
        <p>{{ $product->price }}</p>
    </div>
    
    <div>
        <strong>Quantity:</strong>
        <p>{{ $product->quantity }}</p>
    </div>
    
    <div>
        <strong>Category:</strong>
        <p>{{ $product->category->name }}</p>
    </div>

    @if($product->image)
    <div>
        <strong>Image:</strong>
        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width: 200px; height: auto;">
    </div>
    @endif

    <a href="{{ route('admin.products') }}" class="btn btn-primary">Back to Products</a>
</div>
@endsection
