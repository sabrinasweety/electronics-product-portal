@extends('admin.dashboard')

@section('content')


<div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
              <div>
                <h3 class="fw-bold mb-3">Dashboard</h3>
                <h6 class="op-7 mb-2">Electro</h6>
              </div>
              
            </div>
            <div class="row">
            <div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-icon">
                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                        <p class="card-category">Registered Users</p>
                        <h4 class="card-title">{{ $userCount }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-icon">
                    <div class="icon-big text-center icon-info bubble-shadow-small">
                        <i class="fas fa-user-check"></i>
                    </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                        <p class="card-category">Subscribers</p>
                        <h4 class="card-title">{{ $subscriberCount }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-icon">
                    <div class="icon-big text-center icon-success bubble-shadow-small">
                        <i class="fas fa-luggage-cart"></i>
                    </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                        <p class="card-category">Sales</p>
                        <h4 class="card-title">${{ number_format($totalSales, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-sm-6 col-md-3">
    <div class="card card-stats card-round">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-icon">
                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                        <i class="far fa-check-circle"></i>
                    </div>
                </div>
                <div class="col col-stats ms-3 ms-sm-0">
                    <div class="numbers">
                        <p class="card-category">Orders</p>
                        <h4 class="card-title">{{ $totalOrders }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

  </div>
            <div class="container">
    <div class="row">
   <!-- Registered Users Section (Left Side) -->
   <div class="col-md-4">
            <div class="card card-round">
                <div class="card-body">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Registered Users</div>
                        
                    </div>

                    <!-- Loop through each registered user -->
                    <div class="card-list py-4">
                        @foreach($users as $user)
                        <div class="item-list">
                            <div class="avatar">
                                @if($user->image)
                                    <img src="{{ asset($user->image) }}" alt="..." class="avatar-img rounded-circle" />
                                @else
                                    <span class="avatar-title rounded-circle border border-white bg-primary">{{ substr($user->name, 0, 1) }}</span>
                                @endif
                            </div>
                            <div class="info-user ms-3">
                                <div class="username">{{ $user->name }}</div>
                                <div class="status">{{ $user->role }}</div> <!-- Show user role -->
                            </div>
                            <button class="btn btn-icon btn-link op-8 me-1">
                                <i class="far fa-envelope"></i>
                                
                            </button>
                            <button class="btn btn-icon btn-link btn-danger op-8">
                                <i class="fas fa-ban"></i>
                            </button>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction History Section (Right Side) -->
        <div class="col-md-8">
            <div class="card card-round">
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Transaction History</div>
                        
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Payment Number</th>
                                    <th scope="col" class="text-end">Date & Time</th>
                                    <th scope="col" class="text-end">Amount</th>
                                    <th scope="col" class="text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($transactions->isEmpty())
                                    <tr>
                                        <td colspan="4" class="text-center">No transactions found.</td>
                                    </tr>
                                @else
                                    @foreach($transactions as $transaction)
                                    <tr>
                                        <th scope="row">
                                            <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            Payment from #{{ $transaction->transaction_id }}
                                        </th>
                                        <td class="text-end">{{ $transaction->created_at->format('M d, Y, h:i A') }}</td>
                                        <td class="text-end">${{ number_format($transaction->total_price, 2) }}</td>
                                        <td class="text-end">
                                            <span class="badge badge-success">{{ ucfirst($transaction->status) }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{ $transactions->links() }}
                </div>
            </div>
        
            </div>
            </div>
          

            </div>
            </div>
          
        
@endsection