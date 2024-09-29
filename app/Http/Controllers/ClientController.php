<?php

namespace App\Http\Controllers;

use App\Models\DesignRequest;
use App\Models\Plan;
use App\Models\Client;
use App\Models\Design;
use App\Models\PlanRequest;
use App\Models\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ClientController extends Controller
{


    public function dashboard()
{
    // Get the authenticated client
    $user = Auth::user();
    $client = $user->client;
    // Pass the client data to the view
    return view('client.dashboard', compact('client'));

    }

    public function planGallery(Request $request)
    {
        $user = Auth::user();
        $client = $user->client;
        $plans = Plan::all();
        return view('client.planGallery', compact('plans','client'));
    }
    

    public function designGallery(Request $request)
    {
        $user = Auth::user();
        $client = $user->client;
        $designs = Design::all();
        return view('client.designGallery',compact('designs','client'));
    }
 
    public function viewProfile($id){
        
        $client = Client::find($id);
    
        if (!$client) {
            return redirect()->with('error', 'Staff not found.');
        }
    
        return view('client.Profile', compact('client'));
   
    }

    public function viewEditProfile($id){
        $client = Client::findOrFail($id);
    
        return view('client.editProfile', compact('client'));
    }
    
    public function updateProfile(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:15',
            'profile_image' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
        ]);
    
        // Fetch the client and related user
        $client = Client::findOrFail($id);
        $user = $client->user;
    
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Remove old image if it exists
            if ($client->profile_image && file_exists(public_path($client->profile_image))) {
                unlink(public_path($client->profile_image)); // Deletes old image
            }
    
            // Upload new image
            $profileImageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('images/users/'), $profileImageName);
    
            // Update the image path in the database
            $client->profile_image = 'images/users/' . $profileImageName;
        }
    
        // Update the user's name in the users table
        $user->update([
            'name' => $request->name,
        ]);
    
        // Update client details in the clients table
        $client->update([
            'contact' => $request->contact,
            'place' => $request->place,
            'landmark' => $request->landmark,
            'post' => $request->post,
            'pincode' => $request->pincode,
        ]);
    
        // Redirect to the profile page or wherever necessary
        return redirect()->route('client.viewprofile', $client->id)->with('success', 'Profile updated successfully!');
    }
    
    public function changePswd(Request $request, $id){
        $request->validate([
            'password' => 'required|string|confirmed|min:4',
        ]);
           // Find the staff record by id
        $client = Client::findOrFail($id);
        // Find the associated user record
        $user = $client->user;
         // Update staff details in the Staff table
         $user->update([
            'password' => $request->password,
            
        ]);
        return redirect()->route('client.viewprofile', $client->id)->with('success', 'password updated successfully!');  
    }


}
