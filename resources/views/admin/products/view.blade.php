@extends('admin.dashboard')

@section('content')
    <h1 style="text-align: center; color: #333; margin-bottom: 20px;">Product List</h1>

    @if (session('success'))
        <div class="alert alert-success" style="margin: 15px 0; padding: 10px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 5px;">
            {{ session('success') }}
        </div>
    @endif

    <div style="overflow-x:auto;">
        <table class="table" style="width: 100%; border-collapse: collapse; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);">
            <thead>
                <tr style="background-color: #E6E6FA; color: #333;">
                    <th style="padding: 15px; text-align: left;">Name</th>
                    <th style="padding: 15px; text-align: left;">Description</th>
                    <th style="padding: 15px; text-align: left;">Price</th>
                    <th style="padding: 15px; text-align: left;">Quantity</th>
                    <th style="padding: 15px; text-align: left;">Category</th>
                    <th style="padding: 15px; text-align: left;">Image</th>
                    <th style="padding: 15px; text-align: left;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr class="{{ $loop->even ? 'even-row' : 'odd-row' }}" style="border-bottom: 1px solid #dee2e6;">
                        <td style="padding: 12px; margin: 0;">{{ $product->name }}</td>
                        <td style="padding: 12px; margin: 0;">{{ $product->description }}</td>
                        <td style="padding: 12px; margin: 0; color: #28a745;">${{ number_format($product->price, 2) }}</td>
                        <td style="padding: 12px; margin: 0;">{{ $product->quantity }}</td>
                        <td style="padding: 12px; margin: 0;">{{ $product->category->name }}</td>
                        <td style="padding: 12px; margin: 0;">
                            @if ($product->image)
                                <img src="{{ asset('images/' . $product->image) }}" alt="Product Image" style="width: 50px; height: auto; border-radius: 4px;">
                            @else
                                No Image
                            @endif
                        </td>
                        <td style="padding: 12px; margin: 0;">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-primary" style="background-color: #007bff; color: white; padding: 5px 10px; text-decoration: none; margin-right: 5px;">Edit</a>
                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-secondary" style="background-color: #6c757d; color: white; padding: 5px 10px; text-decoration: none; margin-right: 5px;">Show</a>
                            
                            <form action="{{ route('admin.products.delete', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" style="background-color: #dc3545; color: white; padding: 5px 10px; border: none; cursor: pointer;">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div style="text-align: center; margin-top: 20px;">
        <a href="{{ route('admin.products.create') }}" class="btn btn-success" style="background-color: #28a745; border: none; padding: 10px 15px; border-radius: 5px; color: white; text-decoration: none; margin: 0 5px;">Add New Product</a>
    </div>

    <style>
        .even-row {
            background-color: #f9f9f9; /* Light grey for even rows */
        }
        .odd-row {
            background-color: #ffffff; /* White for odd rows */
        }
        tr:hover {
            background-color: #e2f0d9; /* Light green on hover */
            transition: background-color 0.3s;
        }
        /* Additional styles for padding and margin */
        td {
            padding: 12px; /* Consistent padding for table cells */
            margin: 0; /* Reset margin for table cells */
        }
        th {
            padding: 15px; /* Consistent padding for table headers */
            margin: 0; /* Reset margin for table headers */
        }
        .btn {
            margin: 0 5px; /* Margin for buttons to space them out */
        }
    </style>
@endsection
