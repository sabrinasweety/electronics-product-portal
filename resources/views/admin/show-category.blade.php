{{-- resources/views/admin/categories/show.blade.php --}}

@extends('admin.dashboard') {{-- Extending your main layout --}}

@section('content')
<div class="container mt-5">
    <h1 style="color: #d63384; text-align: center; margin-bottom: 20px;">Category Details</h1>

    {{-- Check if there is any error message --}}
    @if(session('error'))
        <div class="alert alert-danger" style="background-color: #dc3545; color: white; text-align: center; margin-bottom: 20px;">
            {{ session('error') }}
        </div>
    @endif

    <div class="card" style="border: 1px solid #d63384; border-radius: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); background-color: #ffffff; margin: auto; max-width: 600px; height: 300px;">
        <div class="card-body" style="background-color: #f8f9fa; height: 100%; padding: 20px;">
            <h5 class="card-title" style="color: #6610f2; font-weight: bold;">Category Name: {{ $category->name }}</h5>
            <p class="card-text" style="color: #6c757d;">Created At: {{ $category->created_at }}</p>
            <p class="card-text" style="color: #6c757d;">Updated At: {{ $category->updated_at }}</p>
            
            <!-- Button Container with added margin -->
            <div style="text-align: center; margin-top: 40px;">
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary" style="background-color: #6610f2; border: none; padding: 10px 15px; border-radius: 5px; transition: background-color 0.3s;">
                    Edit
                </a>
                <a href="{{ route('admin.categories.delete', $category->id) }}" class="btn btn-danger" style="background-color: #dc3545; border: none; padding: 10px 15px; border-radius: 5px; margin-left: 10px;" onclick="return confirm('Are you sure you want to delete this category?');">
                    Delete
                </a>
                <a href="{{ route('admin.categories') }}" class="btn btn-secondary" style="background-color: #6c757d; border: none; padding: 10px 15px; border-radius: 5px; margin-left: 10px;">
                    Back to Categories
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
