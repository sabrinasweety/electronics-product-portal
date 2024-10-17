<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserAuthController extends Controller
{
    // Show registration form
    public function showRegistrationForm()
    {
        return view('frontend.user.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
        ]);

        return redirect()->route('user.login')->with('success', 'Registration successful! Please log in.');
    }

    // Show login form
    public function showLoginForm()
    {
        return view('frontend.user.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // Handle logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login')->with('success', 'Logged out successfully.');
    }

    // Show profile update form
     public function showProfileForm()
     {
         return view('frontend.user.profile');
      }

    // Handle profile update
    // public function updateProfile(Request $request)
    // {
    //     $user = Auth::user(); // Get the authenticated user
    
    //     // Validation
    //     $validator = Validator::make($request->all(), [
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, // Make sure this is correct
    //         'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    //     ]);
    
    //     if ($validator->fails()) {
    //         return redirect()->back()->withErrors($validator)->withInput();
    //     }
    
    //     // Prepare data to update
    //     $data = [
    //         'name' => $request->name,
    //         'email' => $request->email,
    //     ];
    
    //     // Handle image upload if present
    //     if ($request->hasFile('image')) {
    //         $image = $request->file('image');
    //         $filename = time() . '.' . $image->getClientOriginalExtension();
    //         Storage::putFileAs('public/profile-images', $image, $filename);
    //         $data['image'] = $filename;  // Add image to the update data
    //     }
    
    //     // Update user profile using the update() method
    //     $user->update($data);
    
    //     return redirect()->back()->with('success', 'Profile updated successfully!');
    // }
    

 }

