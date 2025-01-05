<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Chat;
use App\models\Staff;
use App\models\Client;
use App\models\Project;
use App\models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ChatController extends Controller
{
    // ... (keep existing chat() method as is) ...
    public function chat()
    {
        $user = Auth::user();

        $messages = Chat::where(function ($query) use ($user) {
            $query->where('from_id', $user->id)
                  ->orWhere('to_id', $user->id);
        })->orderBy('created_at', 'asc')->get();

        if ($user->role === 'admin') {
            $staffs = Staff::all();
            $clients = Client::all();
            $userId = $user->id;
            $admin = User::where('role', 'admin')->first();
            return view('admin.chat', compact('staffs', 'clients','user','messages','userId','admin'));

        } elseif ($user->role === 'client') {
            $client = $user->client;
            $userId = $client->user->id;
            // Retrieve all projects of the client along with assigned staff
            $projects = Project::with(['staff.user']) // Load both staff and their user
                ->where('client_id', $client->id)
                ->get();
        
            // Retrieve the admin
            $admin = User::where('role', 'admin')->first();
        
            // Return client view with client, projects, admin, and unique architects
            return view('client.chat', compact('client', 'projects', 'admin','user','messages','userId'));
        }
        
         elseif ($user->role === 'architect') {
            $staff = $user->staff;
            $userId = $staff->user->id;
            $admin = User::where('role', 'admin')->first();

            // Get all designers
            $designers = User::whereHas('staff', function ($query) {
                $query->where('role', 'designer');
            })->get();

            $projects = Project::with(['staff.user']) // Load both staff and their user
            ->where('assigned_staff_id', $staff->id)
            ->get();


            return view('architect.chat', compact('staff', 'designers', 'projects','admin','user','messages','userId'));
        } elseif ($user->role === 'designer') {
            $staff = $user->staff;
            $userId = $staff->user->id;
            $admin = User::where('role', 'admin')->first();
            
            $projects = Project::with(['staff.user']) // Load both staff and their user
            ->where('assigned_staff_id', $staff->id)
            ->get();

            $architects = User::whereHas('staff', function ($query) {
                $query->where('role', 'architect');
            })->get();

            return view('designer.chat', compact('staff','projects','architects','admin','user','messages','userId'));
        }
        
    }
    
    // Fetch chat messages between two users
    public function fetchMessages(Request $request, $receiverId)
    {
        $guard = null;
    
        // Check if the user is authenticated as admin, client, architect, or designer
        if (auth('admin')->check()) {
            $guard = 'admin';
        } elseif (auth('client')->check()) {
            $guard = 'client';
        } elseif (auth('architect')->check()) {
            $guard = 'architect';
        } elseif (auth('designer')->check()) {
            $guard = 'designer';
        }
    
        // Get the authenticated user ID using the appropriate guard
        $fromId = $guard ? auth($guard)->user()->id : null;
  
        if (!$fromId) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }
    
        $messages = Chat::where(function ($query) use ($fromId, $receiverId) {
                $query->where('from_id', $fromId)
                      ->where('to_id', $receiverId);
            })
            ->orWhere(function ($query) use ($fromId, $receiverId) {
                $query->where('from_id', $receiverId)
                      ->where('to_id', $fromId);
            })
            ->orderBy('created_at', 'asc')
            ->get();
    
        return response()->json([
            'messages' => $messages
        ]);
    }

    // Send message
    public function sendMessage(Request $request)
    {
        $request->validate([
            'from_id' => 'required|exists:users,id',
            'to_id' => 'required|exists:users,id',
            'message' => 'required_without:image|string|max:255',
            'image' => 'nullable|image|max:2048', // Max 2MB
        ]);
    
        $message = new Chat();
        $message->from_id = $request->from_id;
        $message->to_id = $request->to_id;
        $message->message = $request->message ?? '';

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('chat_images', 'public');
            $message->image_path = asset('storage/' . $path);
        }

        $message->save();
    
        return response()->json(['success' => true, 'message' => $message]);
    }
}