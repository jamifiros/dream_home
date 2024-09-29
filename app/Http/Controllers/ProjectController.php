<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DesignRequest;
use App\Models\Plan;
use App\Models\Client;
use App\Models\Design;
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
        return view('client.Enquiry', compact('plans', 'designs', 'client'));
    }

    public function Projectenquiry(){
        $user = Auth::user();
        $client = $user->client;
        return view('client.enquiry',compact('client'));
    }
    public function showEnquiry()
    {
        // Get the authenticated user's ID
        $clientId = auth()->id();

        // Retrieve pending project requests for the authenticated client with the corresponding plan or design requests
        $projectRequests = ProjectRequest::with(['planRequest', 'designRequest'])
            ->where('client_id', $clientId)
            ->where('status', 'send')
            ->get();
            return view('client.showEnquiry', compact('projectRequests'));
    }

    public function requestPlan(Request $request)
    {
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
        $planRequest->client_id = auth()->id(); // Assuming the user is authenticated
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
        $ProjectRequest->client_id = auth()->id();
        $ProjectRequest->type_id = $planRequest->id;
        $ProjectRequest->type = 'plan';

        $ProjectRequest->save();

        // Redirect back with success message
        return redirect()->route('client.dashboard')->with('success', 'plan request submitted successfully!');
    }

    public function requestDesign(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'work_location' => 'required|string',
            'requirements' => 'required|string',
            'additional_notes' => 'nullable|string',
            'design_model_id' => 'required|exists:designs,id',
        ]);


        $designRequest = new DesignRequest();
        $designRequest->client_id = auth()->id();
        $designRequest->work_location = $validatedData['work_location'];
        $designRequest->model_id = $validatedData['design_model_id'];
        $designRequest->requirements = $validatedData['requirements'];
        $designRequest->additional_info = $validatedData['additional_notes'] ?? null;

        // Save the PlanRequest to the database
        $designRequest->save();

        $ProjectRequest = new ProjectRequest();
        $ProjectRequest->client_id = auth()->id();
        $ProjectRequest->type_id = $designRequest->id;
        $ProjectRequest->type = 'design';

        $ProjectRequest->save();

        // Redirect back with success message
        return redirect()->route('client.dashboard')->with('success', 'Design request submitted successfully!');
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

}
