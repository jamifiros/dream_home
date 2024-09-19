<?php

namespace App\Http\Controllers;

use App\Models\Architect;
use App\Models\Designer;
use App\Models\Client;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Plan;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function showManagePlan(){
        return view('admin.manage_plans');
    }

    public function showManageDesign(){
        return view('admin.manage_designs');
    }

    public function viewFeedbacks()
    {
        // $feedbacks = Feedback::all();
        // return view('admin.feedbacks', compact('feedbacks'));
        return view('admin.feedback');
    }

    public function createPlan(Request $request){
        // Validate the request
    $request->validate([
        'plan_name'=> 'required',
        'plan_type'=> 'required',
        'plan_image'=> 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'no_bhk'=>'required|numeric',
        'no_bathroom'=>'required|numeric',
        'no_floor'=>'required|numeric',
        'estimated_cost'=>'required|numeric'    
    ]);

     // Upload the featured image
     $imageName = time().'.'.$request->featured_image->extension();  
     $request->featured_image->move(public_path('images'), $imageName);
    
     // Create a new product
    $plan = new Plan();
    $plan->plan_name = $request->plan_name;
    $plan ->plan_type = $request ->plan_type;
    $plan ->no_bhk = $request ->no_bhk;
    $plan -> no_bathroom = $request ->no_bathroom;
    $plan -> no_floor = $request ->no_floor;
    $plan -> estimated_cost  = $request ->estimated_cost;
  
    // Store the image path instead of just the image name
    $plan->plan_image = 'images/' . $imageName;
    
    $plan->save();
    // Redirect back with success message
    return redirect()->route('managePlan')->with('success', 'Plan added successfully.');
        
    }

    
    public function viewArchitects()
    {
        $architects = Architect::all();
        return view('admin.architects', compact('architects'));
    }

    public function viewDesigners()
    {
        $designers = Designer::all();
        return view('admin.designers', compact('designers'));
    }

    public function viewClients()
    {
        $clients = Client::all();
        return view('admin.clients', compact('clients'));
    }

 
    public function registerArchitect(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'architect',
        ]);

        return redirect()->route('admin.architects')->with('success', 'Architect registered successfully');
    }

    public function registerDesigner(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'designer',
        ]);

        return redirect()->route('admin.designers')->with('success', 'Designer registered successfully');
    }
}
