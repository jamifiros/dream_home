<?php

namespace App\Http\Controllers;

use App\Models\Architect;
use App\Models\Designer;
use App\Models\Client;
use App\Models\Feedback;
use App\Models\ProjectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Plan;
use App\Models\Design;
use App\Models\Staff;
use Illuminate\Support\Facades\Log;


class AdminController extends Controller
{
    public function dashboard()
    {
        // Assuming you have a ProjectRequest model
       $pendingRequestsCount = ProjectRequest::where('status', 'pending')->count();
    
        // Pass the count to the view
        return view('admin.dashboard', compact('pendingRequestsCount'));
    }

    public function showManagePlan(){
        $plans = Plan::all();
        return view('admin.manage_plans',compact('plans'));
    }

    public function showManageDesign(){
        $designs = Design::all();
        return view('admin.manage_designs',compact('designs'));
    }

    
    public function showManageusers(){
        return view('admin.manage_user');
    }

    public function showManagestaffs(){
        $staffs = Staff::with('user')->whereHas('user', function ($query) {
            $query->whereIn('role', ['architect', 'designer']);
        })->get();
        
        return view('admin.manage_staffs',compact('staffs'));
    }

    public function showManageClients()
    {
        // Fetch clients with their user data where the user's role is 'client'
        $clients = Client::with('user')->whereHas('user', function ($query) {
            $query->where('role', 'client');
        })->get();
    
        return view('admin.manage_clients', compact('clients'));
    }

    public function showprojects(){
        return view('admin.manage_projects');
    }

    public function showrequests(){
        $projectrequests = ProjectRequest::where('status', 'pending')->get();
        return view('admin.manage_requests',compact('projectrequests'));
    }

    public function showClient(){
        return view('admin.clientProfile');
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
         'plan_name' => 'required',
         'plan_type' => 'required',
         'plan_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
         'no_bhk' => 'required|numeric',
         'no_bathroom' => 'required|numeric', // Change this to match the form field
         'no_floor' => 'required|numeric',
         'estimated_cost' => 'required|numeric'
        ]);

      // Upload the plan image
      $imageName = time() . '.' . $request->plan_image->extension();  // Fix the image field name
      $request->plan_image->move(public_path('images/plans/'), $imageName);
      // Create a new plan
      $plan = new Plan();
      $plan->plan_name = $request->plan_name;
      $plan->plan_type = $request->plan_type;
      $plan->no_bhk = $request->no_bhk;
      $plan->no_bathroom = $request->no_bathroom; // Fix the field name here
      $plan->no_floor = $request->no_floor;
      $plan->estimated_cost = $request->estimated_cost;
      $plan->plan_image = 'images/plans/' . $imageName;

      $plan->save();

      // Redirect to manage plans
      return redirect()->route('admin.managePlan')->with('success', 'Plan added successfully!');    
    }

    public function editPlan($id) {
        $plan = Plan::findOrFail($id);
        return view('admin.edit_plan', compact('plan'));
    }

    public function updatePlan(Request $request, $id) {
        // Validate the request
        $request->validate([
            'plan_name' => 'required',
            'plan_type' => 'required',
            'no_bhk' => 'required|numeric',
            'no_bathroom' => 'required|numeric',
            'no_floor' => 'required|numeric',
            'estimated_cost' => 'required|numeric',
            'plan_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Optional validation for image
        ]);
    
        // Find the existing plan by ID
        $plan = Plan::findOrFail($id);
        
        // Update plan details
        $plan->plan_name = $request->plan_name;
        $plan->plan_type = $request->plan_type;
        $plan->no_bhk = $request->no_bhk;
        $plan->no_bathroom = $request->no_bathroom;
        $plan->no_floor = $request->no_floor;
        $plan->estimated_cost = $request->estimated_cost;
    
        // Check if a new image is uploaded
        if ($request->hasFile('plan_image')) {
            // Upload the new image
            $imageName = $request->plan_image->getClientOriginalName();
            $request->plan_image->move(public_path('images/'), $imageName);
            
            // Update the image path
            $plan->plan_image = 'images/plans/' . $imageName;
        }
    
        // Save the updated plan
        $plan->save();
    
        // Redirect back with a success message
        return redirect()->route('admin.managePlan')->with('success', 'Plan updated successfully!');    
    }
    

    
    public function deletePlan($id) {
        $plan = Plan::findOrFail($id);
        $plan->delete();
        
        return redirect()->route('admin.managePlan')->with('success', 'Plan deleted successfully!');
    }
    
    
    // create design
    public function createDesign(Request $request)
    {
        $request->validate([
            'design_name' => 'required|string|max:255',
            'design_type' => 'required|string',
            'estimated_cost' => 'required|numeric',
            'design_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Handle image upload
        $designimagePath = null;
        if ($request->hasFile('design_image')) {
            $designimagePath = time() . '.' . $request->design_image->extension();
            $request->design_image->move(public_path('images/designs/'), $designimagePath);
        }
    
        // Save design to the database
        Design::create([
            'design_name' => $request->design_name,
            'design_type' => $request->design_type,
            'estimated_cost' => $request->estimated_cost,
            'design_image' => 'images/designs/' . $designimagePath,
        ]);
    
        return redirect()->route('admin.manageDesign')->with('success', 'Design created successfully!');
    }

    
    public function editDesign($id) {
        $design = Design::findOrFail($id);
        return view('admin.edit_design', compact('design'));
    }

    public function updateDesign(Request $request, $id)
{
    $request->validate([
        'design_name' => 'required|string|max:255',
        'design_type' => 'required|string',
        'estimated_cost' => 'required|numeric',
        'design_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Find the existing design by ID
    $design = Design::findOrFail($id);

    // Handle image upload
    if ($request->hasFile('design_image')) {
        // Remove old image if it exists
        if ($design->design_image) {
            $oldImagePath = public_path($design->design_image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }

        // Upload new image
        $designimagePath = time() . '.' . $request->design_image->extension();
        $request->design_image->move(public_path('images/Designs/'), $designimagePath);

        // Update the image path in the database
        $design->design_image = 'images/designs/' . $designimagePath;
    }

    // Update design details in the database
    $design->update([
        'design_name' => $request->design_name,
        'design_type' => $request->design_type,
        'estimated_cost' => $request->estimated_cost,
    ]);

    return redirect()->route('admin.manageDesign')->with('success', 'Design updated successfully!');
}

// delete design
public function deleteDesign($id)
{
    $design = Design::find($id);

    if ($design->design_image) {
        // Remove the image file from the server
        $imagePath = public_path('images/designs/' . $design->design_image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Delete the design
    $design->delete();

    return redirect()->route('admin.manageDesign')->with('success', 'Design deleted successfully!');
}

    public function viewClients()
    {
        $clients = Client::all();
        return view('admin.clients', compact('clients'));
    }

    public function addStaff(Request $request){
        $validated=$request->validate([
           'name' => 'required|string|max:255',
           'email' => 'required|email|unique:users,email',
           'password' => 'required|string|confirmed|min:4',
           'contact' => 'required|string|max:15',
           'profile_image' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
           'age' => 'required|integer|min:18|max:100',
           'gender' => 'required|string|max:255',
           'pincode' => 'required|string|max:10',
           'post' => 'required|string|max:255',
           'role' => 'required|string|max:255',
       ]);

       
       // Create the user and store the result in a variable
       $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password), // Correct way to hash password
           'role' => $request->role,
       ]);

       $profileimagePath = null;
       if ($request->hasFile('profile_image')) {
           $profileimagePath = time() . '.' . $request->profile_image->extension();
           $request->profile_image->move(public_path('images/users/'), $profileimagePath);
       }
       // Create the staff record using the user ID
       Staff::create([
           'user_id' => $user->id, // Now you have the user ID
           'contact' => $request->contact,
           'age' => $request->age,
           'gender'=>$request->gender,
           'pincode' => $request->pincode,
           'post' => $request->post,
           'profile_image'=>'images/users/' . $profileimagePath,
       ]);
       return redirect()->route('admin.manageStaffs')->with('success', 'Staff registered successfully');
   }
    
    public function viewstaffprofile($id)
    {
        $staff = Staff::with('user')->find($id);
    
        if (!$staff) {
            // Handle the case where the staff member is not found
            return redirect()->route('admin.manageStaffs')->with('error', 'Staff not found.');
        }
    
        return view('admin.staffProfile', compact('staff'));
    }
    
 
    public function updateStaff(Request $request, $id)
    {
        // Validate the input fields
       $request->validate([
        'contact' => 'required|string|max:15',
        'profile_image' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        'age' => 'required|integer|min:18|max:100',
        'gender' => 'required|string|max:255',
        'pincode' => 'required|string|max:10',
        'post' => 'required|string|max:255',
        'role' => 'required|string|max:255',
     ]);
        // Find the staff record by id
        $staff = Staff::findOrFail($id);
        
        // Find the associated user record
        $user = $staff->user;
    
        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            // Remove old image if it exists
          
            // Upload new image
            $profileimagePath = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('images/users/'), $profileimagePath);
    
            // Update the image path in the database
            $staff->profile_image = 'images/users/' . $profileimagePath;
        }
    
        // Update staff details in the Staff table
        $staff->update([
            'contact' => $request->contact,
            'age' =>  $request->age,
            'gender' =>  $request->gender,
            'post' =>  $request->post,
            'pincode' =>  $request->pincode
        ]);
    
        
    
        return redirect()->route('admin.viewstaffprofile', $staff->id)->with('success', 'Staff profile updated successfully!');
    }
    
    public function changePswd(Request $request, $id){
        $request->validate([
            'password' => 'required|string|confirmed|min:4',
        ]);

           // Find the staff record by id
        $staff = Staff::findOrFail($id);
        
        // Find the associated user record
        $user = $staff->user;
         // Update staff details in the Staff table
         $user->update([
            'password' => $request->password,
            
        ]);
        return redirect()->route('admin.viewstaffprofile', $staff->id)->with('success', 'password updated successfully!');

         
    }

    public function deleteStaff($id)
{
    $staff = Staff::findOrFail($id);
    $staff->delete();

    // Optionally, also delete the associated user if needed
    $user = User::findOrFail($staff->user_id);
    $user->delete();

    return redirect()->route('admin.manageStaffs')->with('success', 'Staff registered successfully');
}


}
