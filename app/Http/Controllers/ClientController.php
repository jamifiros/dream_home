<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function dashboard()
    {
        return view('client.dashboard');
    }

    public function planGallery(Request $request)
    {
        
        $plans = Plan::all();
        return view('client.planGallery', compact('plans'));
    }
    

    public function designGallery()
    {
        return view('client.designGallery');
    }
 

}
