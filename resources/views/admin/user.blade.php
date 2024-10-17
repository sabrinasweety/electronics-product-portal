{{-- resources/views/admin/user.blade.php --}}
@extends('admin.dashboard')

@section('content')
    <div class="container mt-5">
        <h2>Registered Users</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->role }}</td>
                       
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
