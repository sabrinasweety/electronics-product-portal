@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1 class="mb-4">Order Details</h1>

    @if($orders->isEmpty())
        <div class="alert alert-warning">
            No orders found.
        </div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th> Name</th>
                    <th>Email</th>
                    <th>Product Name</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    @foreach($order->orderDetails as $detail)
                        <tr>
                            @if ($loop->first)  <!-- Check if this is the first product in the order -->
                                <td rowspan="{{ $order->orderDetails->count() }}">{{ $order->id }}</td>
                                <td rowspan="{{ $order->orderDetails->count() }}">{{ $order->user->name }}</td>
                                <td rowspan="{{ $order->orderDetails->count() }}">{{ $order->user->email }}</td>
                            @endif
                            <td>{{ $detail->product->name }}</td>
                            <td>{{ $detail->quantity }}</td>
                            <td>${{ number_format($detail->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <!-- Pagination Links -->
        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
