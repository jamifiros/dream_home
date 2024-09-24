<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

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

     public function showRegForm(){
        return view('register');
     }

    
public function createUser(Request $request)
{
    // Validation (as per earlier example)
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:4',
        'contact' => 'required|string|max:15',
        'profile_image'=>'nullable|file|mimes:jpg,png,pdf|max:2048',
        'id_proof' => 'required|file|mimes:jpg,png,pdf|max:2048',
        'id_proof_type' =>'|string|max:255',
    ]);

    // Handle File Upload
        $idProof = time() . '.' . $request->id_proof->extension();
        $request->id_proof->move(public_path('images/userId/'), $idProof);

    $profileImage = null;
    if ($request->hasFile('profile_image')) {
        $profileImage = time() . '.' . $request->profile_image->extension();
        $request->profile_image->move(public_path('images/users/'), $profileImage);
    }
    

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->role = 'client';

    $user->save();

   

    $client = new Client();
    $client -> user_id = $user->id;
    $client -> post = $request->post;
    $client -> pincode = $request->pincode;
    $client -> place = $request->place;
    $client -> landmark =  $request->landmark;
    $client -> contact = $request->contact;
    $client -> id_proof_type = $request->id_proof_type;
    $client->id_proof = $idProof;
    $client->profile_image = $profileImage;
    $client->save();

    // Redirect or login the user
    return redirect()->route('login')->with('success', 'Registered successfully.');
}

public function checkEmail(Request $request)
{
    $email = $request->query('email');

    $exists = User::where('email', $email)->exists();

    return response()->json(['exists' => $exists]);
}

}



