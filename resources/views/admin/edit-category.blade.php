@extends('admin.dashboard')

@section('content')
    <div class="container mt-5">
        <h1 style="color: #d63384; text-align: center; margin-bottom: 20px;">Edit Category</h1>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success" style="background-color: #28a745; color: white; text-align: center; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" class="mb-4" style="max-width: 600px; margin: auto; padding: 20px; border: 1px solid #d63384; border-radius: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); background-color: #f8f9fa;" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" style="font-weight: bold; color: #6610f2;">Category Name:</label>
                <input type="text" name="name" value="{{ $category->name }}" class="form-control" required style="border-color: #6610f2;">
            </div>

            <div class="form-group">
                <label for="image" style="font-weight: bold; color: #6610f2;">Category Image:</label>
                <input type="file" name="image" class="form-control-file" accept="image/*" style="border: 2px solid #6610f2;">
                @if ($category->image)
                    <div class="mt-2">
                        <img src="{{ asset('images/categories/'.$category->image) }}" alt="{{ $category->name }}" class="img-thumbnail" style="max-width: 150px; margin-top: 10px;">
                    </div>
                    <small class="text-muted">Current Image</small>
                @endif
            </div>

            <button type="submit" class="btn" style="background-color: #6610f2; color: white; border: none; padding: 10px 15px; border-radius: 5px; transition: background-color 0.3s;">
                Update Category
            </button>
        </form>

        <!-- Back to Categories button in the middle of the page -->
        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('admin.categories') }}" class="btn btn-secondary" style="text-decoration: none; background-color: #6c757d; color: white; padding: 10px 15px; border-radius: 5px; display: inline-block;">
                Back to Categories
            </a>
        </div>
    </div>
@endsection
