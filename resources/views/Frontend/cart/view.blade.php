<!-- resources/views/cart/view.blade.php -->

@extends('frontend.master')

@section('title', 'Your Cart')

@section('content')
    <h1>Your Shopping Cart</h1>

    <!-- Display success and error messages -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Cart Table -->
    @if(count($cart) > 0)
        <form action="{{ route('cart.update') }}" method="POST">
            @csrf
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $details)
                        <tr>
                            <td>
                                <img src="{{ asset('images/' . $details['image']) }}" width="100" height="100" alt="{{ $details['name'] }}">
                            </td>
                            <td>{{ $details['name'] }}</td>
                            <td>${{ $details['price'] }}</td>
                            <td>
                                <input type="hidden" name="id[]" value="{{ $id }}">
                                <input type="number" name="quantity[]" value="{{ $details['quantity'] }}" class="form-control" min="1">
                            </td>
                            <td>${{ $details['price'] * $details['quantity'] }}</td>
                            <td>
                                <a href="{{ route('cart.remove', $id) }}" class="btn btn-danger">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-success">Update Cart</button>
        </form>

        <!-- Display total price -->
        <div class="total-price" style="margin-top: 20px;">
            <h3>Total Price: 
                ${{ array_reduce($cart, function($sum, $item) { 
                    return $sum + ($item['price'] * $item['quantity']); 
                }, 0) }}
            </h3>
        </div>
    @else
        <p>Your cart is empty.</p>
    @endif
@endsection
