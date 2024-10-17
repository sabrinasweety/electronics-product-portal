@extends('frontend.master')

@section('title', 'Checkout')

@section('content')
@if (!auth()->check())
    <script>
        window.location.href = "{{ route('user.login') }}";
    </script>
@else
<form action="{{ route('checkout.placeOrder') }}" method="POST">
    @csrf
    <div class="container">
        <h1 class="text-center my-4">Checkout</h1>

        <!-- Display success and error messages -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <!-- Check if the cart exists and has items -->
        @if(isset($cart) && count($cart) > 0)
           
            <h3 class="mt-4">Shipping Information</h3>

            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name">Receiver Name:</label>
                        <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email_address">Email Address:</label>
                        <input type="email" name="email_address" class="form-control" value="{{ auth()->user()->email }}" required>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="address">Address:</label>
                <input type="text" name="address" class="form-control" required>
            </div>

            <div class="form-group mb-3">
                <label for="phone_number">Mobile Number:</label>
                <input type="text" name="phone_number" class="form-control" required>
            </div>

            <h3 class="mt-4">Your Cart</h3>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cart as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>${{ number_format($item['price'], 2) }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>${{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Display total price -->
            <div class="total-price my-4">
                <h4>Total Price: 
                    ${{ number_format(array_reduce($cart, function($sum, $item) { 
                        return $sum + ($item['price'] * $item['quantity']); 
                    }, 0), 2) }}
                </h4>
            </div>

            <button type="submit" class="btn btn-success btn-lg btn-block">Place Order</button>
        @else
            <p class="text-danger">Your cart is empty. Please add items to your cart before proceeding to checkout.</p>
        @endif
    </div>
</form>
@endif
@endsection
