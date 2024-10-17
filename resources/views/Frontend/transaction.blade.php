@extends('frontend.master')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Transaction History</h1>

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($transactions->isEmpty())
            <div class="alert alert-warning text-center">
                <strong>You have no transactions yet.</strong>
            </div>
        @else
            @foreach($transactions as $transaction)
                <div id="transaction-{{ $transaction->transaction_id }}" class="card mb-4 shadow-sm border" style="border: 2px solid blue; background-color: white; color: black; padding:10px">
                    <div class="card-header d-flex justify-content-between align-items-center bg-light">
                        <h5 class="mb-0">Transaction ID: {{ $transaction->transaction_id }}</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>Status:</strong> {{ ucfirst($transaction->status) }}</p>
                        <p><strong>Total Price:</strong> ${{ number_format($transaction->total_price, 2) }}</p>
                        <p><strong>Created At:</strong> {{ $transaction->created_at->format('d-m-Y H:i:s') }}</p>

                        <h4 class="mt-4">Ordered Products:</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transaction->orderDetails as $orderDetail)
                                    <tr>
                                        <td>{{ $orderDetail->product->name }}</td>
                                        <td>{{ $orderDetail->quantity }}</td>
                                        <td>${{ number_format($orderDetail->subtotal, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Print button -->
                        <div class="text-center mt-5" style="padding: 5px; margin: 5px; background-color: white;">
                            <button class="btn btn-primary" onclick="printTransaction('{{ $transaction->transaction_id }}')">Print</button>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                {{ $transactions->links() }} <!-- Laravel's pagination links -->
            </div>
        @endif
    </div>

    <script>
        function printTransaction(transactionId) {
            // Get the transaction card by ID
            const printContents = document.getElementById('transaction-' + transactionId).innerHTML;
            const originalContents = document.body.innerHTML;

            // Replace the body content with the transaction details
            document.body.innerHTML = printContents;

            // Print the current page
            window.print();

            // Restore the original body content
            document.body.innerHTML = originalContents;
        }
    </script>
@endsection
