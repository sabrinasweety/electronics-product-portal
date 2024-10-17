{{-- resources/views/admin/subscribers.blade.php --}}
@extends('admin.dashboard')

@section('content')
<div class="container mt-5">
   
<h3 class="mb-4 text-center" style="color:blue; font-style: italic; font-weight: bold;">Subscribers List</h3>


    <div class="card shadow-sm" style="max-width: 1000px; margin: 0 auto;">
    <div class="card-header" style="padding: 10px;">
            <h5 class="mb-0">Subscriber Details</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>Email</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subscribers as $subscriber)
                        <tr>
                            <td>{{ $subscriber->email }}</td>
                            <td>{{ $subscriber->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($subscribers->isEmpty())
                <div class="alert alert-warning text-center" role="alert">
                    No subscribers found.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
