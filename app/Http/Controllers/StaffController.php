<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use App\Models\Plan;
use App\Models\Project;
use App\Models\Staff;
use App\Models\Design;
use Carbon\Carbon;


use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $staff = $user->staff;
        if ($user->role === 'architect') {

            return view('architect.dashboard', compact('staff'));
        } elseif ($user->role === 'designer') {
            return view('designer.dashboard', compact('staff'));
        }

    }

    public function PlanGallery()
    {
        $plans = Plan::all();
        $user = Auth::user();
        $staff = $user->staff;
        return view('architect.manage_plans', compact('plans', 'staff'));
    }

    public function createPlan(Request $request)
    {
        // Validate the request
        $request->validate([
            'plan_name' => 'required',
            'plan_type' => 'required',
            'plan_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_bhk' => 'required|numeric',
            'no_bathroom' => 'required|numeric', // Change this to match the form field
            'no_floor' => 'required|numeric',
            'sqft' => 'required|numeric',
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
        $plan->sqft = $request->sqft;
        $plan->estimated_cost = $request->estimated_cost;
        $plan->plan_image = 'images/plans/' . $imageName;

        $plan->save();

        // Redirect to manage plans
        return redirect()->route('architect.planGallery')->with('success', 'Plan added successfully!');
    }

    public function viewPlanEditform($id)
    {
        $plan = Plan::findOrFail($id);
        return view('architect.edit_plan', compact('plan'));
    }

    public function updatePlan(Request $request, $id)
    {
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
        return redirect()->route('architect.planGallery')->with('success', 'Plan updated successfully!');
    }



    public function deletePlan($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return redirect()->route('architect.planGallery')->with('success', 'Plan deleted successfully!');
    }

    public function DesignGallery()
    {
        $designs = Design::all();
        $user = Auth::user();
        $staff = $user->staff;
        return view('designer.manage_designs', compact('designs', 'staff'));
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

        return redirect()->route('designer.designGallery')->with('success', 'Design created successfully!');
    }

    public function viewDesignEditform($id)
    {
        $user = Auth::user();
        $staff = $user->staff;
        $design = design::findOrFail($id);
        return view('designer.edit_design', compact('design','staff'));
    }


    public function editDesign($id)
    {
        $design = Design::findOrFail($id);
        return view('design.edit_design', compact('design'));
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

        return redirect()->route('designer.designGallery')->with('success', 'Design updated successfully!');
    }

    // delete design
    public function deleteDesign($id)
    {
        $design = Design::find($id);
    
        if ($design) {
            // Design exists, so delete it
            $design->delete();
    
            return redirect()->route('designer.designGallery')->with('success', 'Design deleted successfully!');
        } else {
            // Handle the case where the design is not found
            return redirect()->route('designer.designGallery')->with('error', 'Design not found.');
        }
    }
    
    public function viewProfile()
    {
        $user = Auth::user();
        $staff = $user->staff;

        if (!$staff) {
            // Handle the case where the staff member is not found
            return redirect()->back()->with('error', 'Profile not found.');
        }

        if ($staff->User->role === 'architect')
            return view('architect.Profile', compact('staff'));
        elseif ($staff->User->role === 'designer')
            return view('designer.Profile', compact('staff'));
    }


    public function viewProjects()
    {
        $user = Auth::user();
        $staff = $user->staff;
    
        // Fetch all projects assigned to the staff
        $projects = Project::with(['Projectrequest'])
            ->where('assigned_staff_id', $staff->id)
            ->get();
    
        // Fetch projects updated today with status "in_progress"
        $waiting = Project::with(['Projectrequest'])
            ->where('assigned_staff_id', $staff->id)
            ->whereDate('updated_at', Carbon::today())
            ->where('status', 'in_progress')
            ->get();
    
        // Fetch projects with status "completed" or "in_progress"
        $onprogress = Project::with(['Projectrequest'])
            ->where('assigned_staff_id', $staff->id)
            ->where('status', 'in_progress')
            ->get();

        $completed = Project::with(['Projectrequest'])
            ->where('assigned_staff_id', $staff->id)
            ->where('status', 'completed')
            ->get();
    
        // Render view based on role
        if ($staff->User->role === 'architect') {
            return view('architect.manage_projects', compact('projects', 'waiting', 'onprogress', 'completed', 'staff'));
        } elseif ($staff->User->role === 'designer') {
            return view('designer.manage_projects', compact('projects', 'waiting','onprogress', 'completed', 'staff'));
        }
    }
    

    public function projectDetails($id)
    {
        $project = Project::find($id);
        $user = Auth::user();
        $staff = $user->staff;


        // Check if project exists
        if (!$project) {
            return redirect()->back()->with('error', 'Project not found.');
        }

        if ($staff->User->role === 'architect')
            return view('architect.Project_details', compact('project','staff'));
        elseif ($staff->User->role === 'designer')
            return view('designer.Project_details', compact('project','staff'));

    }


    public function updateProject($id)
    {
        // Find the project by ID
        $project = Project::find($id);

        $user = Auth::user();
        $staff = $user->staff;

        // Check if project exists
        if (!$project) {
            return redirect()->back()->with('error', 'Project not found.');
        }

        // Update the status to 'terminated' (or any appropriate status)
        $project->status = 'completed';
        $project->save();

        $payment = new Payment();
        $payment->client_id = $project->client_id; 
        $payment->project_id = $project->id; 
        $payment->payment_method = null; 
        $payment->status = 'pending'; 
        $payment->save();

        // Redirect back with success message

        if ($staff->User->role === 'architect')
        return redirect()->route('architect.viewProjects')->with('success', 'Project updated successfully');
        elseif ($staff->User->role === 'designer')
        return redirect()->route('designer.viewProjects')->with('success', 'Project updated successfully');

    }

}
