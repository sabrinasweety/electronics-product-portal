@extends('admin.dashboard')

@section('content')
    <h1 class="mt-5 text-primary" style="margin-left: 20px;">Manage Categories</h1>

    <!-- Success Message -->
    @if (session('success'))
        <div class="alert alert-success mx-3" style="background-color: #28a745; color: white;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form to add new category -->
    <form action="{{ route('admin.categories.create') }}" method="POST" class="mb-4 mx-3" enctype="multipart/form-data">
        @csrf
        <div class="input-group">
            <input type="text" name="name" class="form-control" placeholder="Enter category name" required style="border: 2px solid #6610f2; border-radius: 5px;">
            <input type="file" name="image" class="form-control-file" accept="image/*" style="border: 2px solid #6610f2; border-radius: 5px; margin-left: 10px;">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit" style="background-color: #6610f2; border: 2px solid #6610f2; border-radius: 5px;">Add Category</button>
            </div>
        </div>
    </form>

    <h2 class="text-primary mx-3">Category List</h2>
    <ul class="list-group mx-3">
        @foreach ($categories as $category)
            <li class="list-group-item d-flex justify-content-between align-items-center" style="border: 2px solid #d63384; border-radius: 5px; margin-bottom: 10px;">
                <div class="d-flex align-items-center">
                    @if ($category->image)
                        <img src="{{ asset('images/categories/'.$category->image) }}" alt="{{ $category->name }}" class="img-thumbnail" style="width: 50px; height: 50px; margin-right: 10px;">
                    @endif
                    <span style="color: #6c757d;">{{ $category->name }}</span>
                </div>
                <div>
                    <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-info btn-sm" style="margin-right: 10px;">Show</a>
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm" style="margin-right: 10px;">Edit</a>
                    <a href="{{ route('admin.categories.delete', $category->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</a>
                </div>
            </li>
        @endforeach
    </ul>
@endsection
