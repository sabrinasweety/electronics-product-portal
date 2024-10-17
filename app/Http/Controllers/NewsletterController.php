<?php

namespace App\Http\Controllers;
use App\Models\Newsletter;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsletterController extends Controller
{
    
        public function subscribe(Request $request)
    {
            // Check if the user is already subscribed
    if (Newsletter::where('email', Auth::user()->email)->exists()) {
        return redirect()->back()->with('error', 'You are already subscribed to the newsletter.');
    }


        // Validate the email
        $request->validate([
            'email' => 'required|email|unique:newsletters,email'
        ]);

        // Get the authenticated user
        $user = Auth::user();

        // Create the newsletter subscription
        Newsletter::create([
            'user_id' => $user->id,
            'email' => $request->email,
        ]);

        return redirect()->back()->with('success', 'You have successfully subscribed to the newsletter!');
    }
}
