<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     // Show login form
     public function showLoginForm()
     {
         return view('auth.login'); // Create a login view later
     }
 
     // Handle login request
     public function login(Request $request)
     {
         $request->validate([
             'email' => 'required|email',
             'password' => 'required',
         ]);
 
         if (Auth::attempt($request->only('email', 'password'))) {
             // Check if the logged-in user is an admin
             if (Auth::user()->role === 'admin') {
                 return redirect()->route('dashboard');
             } else {
                 Auth::logout();
                 return back()->withErrors(['email' => 'Access denied for non-admin users.']);
             }
         }
 
         return back()->withErrors(['email' => 'Invalid credentials.']);
     }
 
     // Logout
     public function logout()
     {
         Auth::logout();
         return redirect()->route('login');
     }
}
