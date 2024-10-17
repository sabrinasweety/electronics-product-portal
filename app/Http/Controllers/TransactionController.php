<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transaction()
{
    // Log whether the user is authenticated
    Log::info('User is authenticated: ' . (auth()->check() ? 'Yes' : 'No'));

    // Check if the user is authenticated
    if (!auth()->check()) {
        return redirect()->route('user.login')->with('error', 'You need to login to view your transactions.');
    }

    // Fetch transactions for the authenticated user, with eager loading of order details
    $transactions = Order::with('orderDetails.product') // Eager load order details and associated products
        ->where('user_id', auth()->user()->id)
        ->orderBy('created_at', 'desc')
        ->paginate(5);

    // Pass the transactions to the view
    return view('frontend.transaction', compact('transactions'));
}



}
