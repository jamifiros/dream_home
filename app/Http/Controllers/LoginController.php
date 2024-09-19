<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
     // Show the login form
     public function showLoginForm()
     {
         return view('login');
     }
 
     // Handle login request
     public function login(Request $request)
     {
         // Validate the request
         $request->validate([
             'email' => 'required|email',
             'password' => 'required',
         ]);
 
         // Attempt to log the user in
         $credentials = $request->only('email', 'password');
 
         if (Auth::attempt($credentials)) {
             // Authentication passed, get the authenticated user
             $user = Auth::user();
 
             // Redirect based on user role
             switch ($user->role) {
                 case 'admin':
                     return redirect()->intended(route('admin.dashboard'));
                 case 'architect':
                     return redirect()->intended(route('architect.dashboard'));
                 case 'designer':
                     return redirect()->intended(route('designer.dashboard'));
                 case 'client':
                     return redirect()->intended(route('client.dashboard'));
                 default:
                     Auth::logout();
                     return redirect('/login')->withErrors(['role' => 'Unauthorized access.']);
             }
         }
 
         // Authentication failed, redirect back with error
         return redirect()->back()->withInput($request->only('email'))
                                  ->withErrors(['email' => 'The provided credentials do not match our records.']);
     }
     // Log out user
     public function logout(Request $request)
     {
         Auth::logout();
         $request->session()->invalidate();
         $request->session()->regenerateToken();
 
         return redirect('/');
     }
}



