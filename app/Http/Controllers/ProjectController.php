<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DesignRequest;
use App\Models\Plan;
use App\Models\Client;
use App\Models\User;
use App\Models\Design;
use App\Models\Payment;
use App\Models\Project;
use App\Models\PlanRequest;
use App\Models\ProjectRequest;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function enquiry()
    {
        $plans = Plan::all();
        $designs = Design::all();
        $user = Auth::user();
        $client = $user->client;
        return view('client.newEnquiry', compact('plans', 'designs', 'client'));
    }

    public function Projectenquiry(){
        $user = Auth::user();
        $client = $user->client;
        return view('client.enquiry',compact('client','client'));
    }
    public function showEnquiry()
    {
         $user = Auth::user();
        $client = $user->client;
        // Get the authenticated user's ID
        $clientId = $client->id;

        // Retrieve pending project requests for the authenticated client with the corresponding plan or design requests
        $projectRequests = ProjectRequest::with(['planRequest', 'designRequest'])
            ->where('client_id', $clientId)
            ->get();
            return view('client.showEnquiry', compact('projectRequests','client'));
    }

    public function requestPlan(Request $request)
    {
        $user = Auth::user();
        $client = $user->client;
        // Validate the incoming request data
        $validatedData = $request->validate([
            'plot_size' => 'required|string|max:255',
            'work_location' => 'required|string|max:255',
            'no_bhk' => 'required|integer|min:1',
            'no_floors' => 'required|integer|min:1',
            'no_bathrooms' => 'required|integer|min:1',
            'requirements' => 'required|string',
            'additional_notes' => 'nullable|string',
            'attachments' => 'nullable|file|mimes:jpg,png,pdf|max:2048', // 2MB Max
            'model_id' => 'required|exists:plans,id',
        ]);

        // Create and save the PlanRequest instance
        $planRequest = new PlanRequest();
        $planRequest->client_id = $client->id;
        $planRequest->model_id = $validatedData['model_id'];
        $planRequest->plot_size = $validatedData['plot_size'];
        $planRequest->work_location = $validatedData['work_location'];
        $planRequest->no_bhk = $validatedData['no_bhk'];
        $planRequest->no_floors = $validatedData['no_floors'];
        $planRequest->no_bathrooms = $validatedData['no_bathrooms'];
        $planRequest->requirements = $validatedData['requirements'];
        $planRequest->additional_info = $validatedData['additional_notes'] ?? null;

        // Handle file upload if an attachment is present
        if ($request->hasFile('attachments')) {
            $ImagePath = time() . '.' . $request->attachments->extension();
            $request->attachments->move(public_path('images/plotImages/'), $ImagePath);
            $planRequest->plot_image = 'images/plotImages/' . $ImagePath;
        }

        // Save the PlanRequest to the database
        $planRequest->save();

        $ProjectRequest = new ProjectRequest();
        $ProjectRequest->client_id = $client->id;
        $ProjectRequest->type_id = $planRequest->id;
        $ProjectRequest->type = 'plan';

        $ProjectRequest->save();

        // Redirect back with success message
        return redirect()->route('client.ProjectEnquiry')->with('success', 'plan request submitted successfully!');
    }

    public function requestDesign(Request $request)
    {
        $user = Auth::user();
        $client = $user->client;
        // Validate the incoming request data
        $validatedData = $request->validate([
            'work_location' => 'required|string',
            'requirements' => 'required|string',
            'additional_notes' => 'nullable|string',
            'design_model_id' => 'required|exists:designs,id',
        ]);


        $designRequest = new DesignRequest();
        $designRequest->client_id = $client->id;
        $designRequest->work_location = $validatedData['work_location'];
        $designRequest->model_id = $validatedData['design_model_id'];
        $designRequest->requirements = $validatedData['requirements'];
        $designRequest->additional_info = $validatedData['additional_notes'] ?? null;

        // Save the PlanRequest to the database
        $designRequest->save();

        $ProjectRequest = new ProjectRequest();
        $ProjectRequest->client_id = $client->id;
        $ProjectRequest->type_id = $designRequest->id;
        $ProjectRequest->type = 'design';

        $ProjectRequest->save();

        // Redirect back with success message
        return redirect()->route('client.ProjectEnquiry')->with('success', 'Design request submitted successfully!');
    }

    public function requestDetails($id)
    {
        // Retrieve the ProjectRequest by its ID
        $projectRequest = ProjectRequest::with(['planRequest', 'designRequest', 'planRequest.client', 'designRequest.client'])->find($id);

        if (!$projectRequest) {
            return redirect()->back()->with('error', 'Request not found.');
        }

        // Get the client details
        $client = $projectRequest->planRequest ? $projectRequest->planRequest->client : $projectRequest->designRequest->client;

        return view('admin.requestDetails', compact('projectRequest', 'client'));

    }

    public function addBudget(Request $request, $id)
    {
        // Validate the incoming request for budget
        $this->validate($request, [
            'budget' => 'required|numeric|min:0', // Ensure budget is a positive number
        ]);

        // Find the ProjectRequest with the specified ID
        $projectRequest = ProjectRequest::with(['planRequest', 'designRequest'])
            ->find($id);

        // Check if the project request exists
        if (!$projectRequest) {
            return redirect()->back()->withErrors(['error' => 'Project request not found.']);
        }

        // Retrieve the budget from the request
        $requestedBudget = $request->input('budget');

        // Check the type and update the estimated budget accordingly
        if ($projectRequest->type == 'plan') {
            // Update the estimated budget for the associated plan request
            if ($projectRequest->planRequest) {
                $projectRequest->planRequest->estimated_cost = $requestedBudget;
                $projectRequest->planRequest->save(); // Save the updated plan request
            }
        } elseif ($projectRequest->type == 'design') {
            // Update the estimated budget for the associated design request
            if ($projectRequest->designRequest) {
                $projectRequest->designRequest->estimated_cost = $requestedBudget;
                $projectRequest->designRequest->save(); // Save the updated design request
            }
        }

        // Update the status of the project request to 'send'
        $projectRequest->status = 'send';
        $projectRequest->save(); // Save the updated project request

        return redirect()->route('admin.viewRequests')->with('success', 'Budget added successfully and status updated.');
    }

    public function refuseRequest($id){
        $projectRequest = ProjectRequest::find($id);

        $projectRequest ->status = 'refused';
        $projectRequest->save();

        return redirect()->back();

    }

    public function acceptRequest($id)
    {
        // Find the project request by ID
        $projectRequest = ProjectRequest::find($id);
    
        // Check if project request exists
        if (!$projectRequest) {
            return redirect()->back()->with('error', 'Project request not found.');
        }
    
        // Update the project request status to 'approved'
        $projectRequest->status = 'approved';
        $projectRequest->save();
    
        // Create a new project when the request is approved
        $project = new Project();
        $project->client_id = $projectRequest->client_id; // Assuming projectRequest has client_id
        $project->project_request_id = $projectRequest->id; // Link the project request to the new project
        $project->assigned_staff_id = null; // Optionally, this can be null initially
        $project->status = 'pending'; // Initial status for the project
    
        // Save the new project
        $project->save();
    
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Project request approved, and new project created.');
    }
    
    public function terminateRequest($id)
    {
        // Find the project by ID
        $projectRequests = ProjectRequest::find($id);
    
        // Check if project exists
        if (!$projectRequests) {
            return redirect()->back()->with('error', 'Project not found.');
        }
    
        // Update the status to 'terminated' (or any appropriate status)
        $projectRequests->status = 'rejected';
    
        // Save the changes
        $projectRequests->save();
    
        // Redirect back with success message
        return redirect()->route('admin.viewRequests')->with('success', 'Project has been successfully terminated.');
    }
    
    
    public function showprojects(){
        $projectRequests =ProjectRequest::with(['planRequest', 'designRequest']);
        $projects = Project::with(['client', 'staff','projectRequests']);
        $architects = User::where('role','architect')->get();
        $designers = User::where('role','designer')->get();

        $waiting = Project::where('status','pending')->get();
        $onprogress = Project::where('status','in_progress')->get();
        $completed = Project::where('status','completed')->get();

        $paid = Payment::where('status','paid')->get();

        return view('admin.projects', compact('projects','waiting','onprogress','completed','paid','designers','architects'));
    }

    public function assignStaff(Request $request)
    {
        $project = Project::find($request->project_id);
    
    
        if ($project) {
            $project->assigned_staff_id = $request->staff_id;
            $project->status = 'in_progress'; 
            $project->save();
    
            return redirect()->route('admin.viewProjects')->with('success', 'Staff assigned successfully');
        }
    
        return response()->json(['error' => 'Project not found'], 404);
    }
    
    public function terminateProject($id)
    {
        // Find the project by ID
        $project = Project::find($id);
    
        // Check if project exists
        if (!$project) {
            return redirect()->back()->with('error', 'Project not found.');
        }
    
        // Update the status to 'terminated' (or any appropriate status)
        $project->status = 'terminated';
    
        // Save the changes
        $project->save();
    
        // Redirect back with success message
        return redirect()->route('admin.viewProjects')->with('success', 'Project has been successfully terminated.');
    }
    
    // public function viewBill($id){
    //     $project = Project::find($id);

    //     return view('admin.bill',compact('project'));        

    // }

    public function viewBill($id)
{
    $project = Project::find($id);

    // Check if project has a related plan or design request and get the estimated cost
    $estimated_cost = 0;

    if ($project->projectRequest->type === 'plan' && $project->projectRequest->planRequest) {
        $estimated_cost = $project->projectRequest->planRequest->estimated_cost;
    } elseif ($project->projectRequest->type === 'design' && $project->projectRequest->designRequest) {
        $estimated_cost = $project->projectRequest->designRequest->estimated_cost;
    }

    // Calculate SGST and CGST (9% each)
    $sgst = $estimated_cost * 0.09;
    $cgst = $estimated_cost * 0.09;

    // Calculate total amount
    $total_amount = $estimated_cost + $sgst + $cgst;

    // Pass all the values to the view
    return view('admin.bill', compact('project', 'estimated_cost', 'sgst', 'cgst', 'total_amount'));
}


public function makePayment(Request $request, $id)
{
    // Find the project by its ID
    $project = Project::find($id);
    $user = Auth::user();
    $client = $user->client;

    // Find the payment associated with the project
    $payment = Payment::where('project_id', $project->id)->first();

    // Check if the payment record exists
    if ($payment) {
        // Update the payment status to 'paid' and set the payment_method from the request
        $payment->status = 'paid';
        $payment->amount = $request->input('amount');
        $payment->payment_method = $request->input('payment_method'); // Assuming the payment method is passed in the form
        $payment->save(); // Save the changes

        return redirect()->back()->with('success', 'Payment completed successfully!');
    } else {
        return redirect()->back()->with('error', 'Payment not found for this project.');
    }
}


}
