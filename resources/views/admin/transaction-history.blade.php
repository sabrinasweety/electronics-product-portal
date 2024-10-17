@extends('admin.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Transaction History</div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Payment Number</th>
                                        <th scope="col" class="text-start">Receiver Name</th>
                                        <th scope="col" class="text-start">Receiver Email</th>
                                        <th scope="col" class="text-end">Date & Time</th>
                                        <th scope="col" class="text-end">Amount</th>
                                        <th scope="col" class="text-end">Status</th>
                                        <th scope="col" class="text-end">Ordered Products</th> <!-- Added column for ordered products -->
                                        <th scope="col" class="text-end">Print</th> <!-- Added print button column -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($transactions->isEmpty())
                                        <tr>
                                            <td colspan="8" class="text-center">No transactions found.</td>
                                        </tr>
                                    @else
                                        @foreach($transactions as $transaction)
                                            <tr id="transaction-{{ $transaction->id }}">
                                                <th scope="row">Payment from #{{ $transaction->transaction_id }}</th>
                                                <td>{{ $transaction->receiver_name ?? 'N/A' }}</td>
                                                <td>{{ $transaction->receiver_email ?? 'N/A' }}</td>
                                                <td class="text-end">{{ $transaction->created_at->format('M d, Y, h:i A') }}</td>
                                                <td class="text-end">${{ number_format($transaction->total_price, 2) }}</td>
                                                <td class="text-end">
                                                    <span class="badge badge-success">{{ ucfirst($transaction->status) }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <!-- Display ordered products and quantities -->
                                                    <ul class="list-unstyled">
                                                        @foreach($transaction->orderDetails as $detail)
                                                            <li>{{ $detail->product->name }} - Quantity: {{ $detail->quantity }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td class="text-end">
                                                    <!-- Added print button for each row -->
                                                    <button onclick="printTransaction('transaction-{{ $transaction->id }}')" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-print"></i> Print
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        {{ $transactions->links() }} <!-- Pagination links -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript function for printing individual transactions -->
    <script>
        function printTransaction(transactionId) {
            var printContent = document.getElementById(transactionId).outerHTML;
            var originalContent = document.body.innerHTML;

            document.body.innerHTML = '<table class="table">' + printContent + '</table>';
            window.print();
            document.body.innerHTML = originalContent;
        }
    </script>
@endsection
