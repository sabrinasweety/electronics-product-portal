<!-- resources/views/admin/products/edit-product.blade.php -->

@extends('admin.dashboard')

@section('content')
<h1>Edit Product</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    

    <div class="form-group">
        <label for="name">Product Name:</label>
        <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
    </div>

    <div class="form-group">
        <label for="description">Product Description:</label>
        <textarea name="description" class="form-control">{{ $product->description }}</textarea>
    </div>

    <div class="form-group">
        <label for="price">Price:</label>
        <input type="text" name="price" class="form-control" value="{{ $product->price }}" required>
    </div>

    <div class="form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" class="form-control" value="{{ $product->quantity }}" required>
    </div>

    <div class="form-group">
        <label for="category_id">Category:</label>
        <select name="category_id" class="form-control">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="image">Product Image:</label>
        <input type="file" name="image" class="form-control">
        @if ($product->image)
            <img src="{{ asset('images/' . $product->image) }}" alt="Product Image" width="100">
        @endif
    </div>

    <button type="submit" class="btn btn-primary">Update Product</button>
</form>
@endsection
