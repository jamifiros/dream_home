<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Plan;
use App\Models\Design;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    
    public function index()
    {
        $plans = Plan::all();
        $designs = Design::all();
        return view('home',compact('plans','designs'));
    }
    // Show the login form
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Check user role and log in with the respective guard
            switch ($user->role) {
                case 'admin':
                    Auth::guard('admin')->login($user);
                    return redirect()->route('admin.dashboard');
                case 'client':
                    Auth::guard('client')->login($user);
                    return redirect()->route('client.dashboard');
                case 'architect':
                    Auth::guard('architect')->login($user);
                    return redirect()->route('architect.dashboard');
                case 'designer':
                    Auth::guard('designer')->login($user);
                    return redirect()->route('designer.dashboard');
                default:
                    Auth::logout();
                    return redirect()->route('login');
            }
        }
    
        return redirect()->route('login')->withErrors('Login details are incorrect.');
    }
    

    public function logout(Request $request)
{
    if (Auth::guard('admin')->check()) {
        Auth::guard('admin')->logout();
    } elseif (Auth::guard('client')->check()) {
        Auth::guard('client')->logout();
    } elseif (Auth::guard('architect')->check()) {
        Auth::guard('architect')->logout();
    } elseif (Auth::guard('designer')->check()) {
        Auth::guard('designer')->logout();
    } else {
        Auth::guard('web')->logout(); 
    }

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
}


    public function showRegForm()
    {
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
            'profile_image' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
            'id_proof' => 'required|file|mimes:jpg,png,pdf|max:2048',
            'id_proof_type' => '|string|max:255',
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
        $client->user_id = $user->id;
        $client->post = $request->post;
        $client->pincode = $request->pincode;
        $client->place = $request->place;
        $client->landmark = $request->landmark;
        $client->contact = $request->contact;
        $client->id_proof_type = $request->id_proof_type;
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



