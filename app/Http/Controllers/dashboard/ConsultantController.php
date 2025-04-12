<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Consultant;
use Illuminate\Support\Facades\Auth;

class ConsultantController extends Controller
{
    public function index()
    {
        return view('dashboards.consultants.index');
    }

    public function show()
    {
        return view('dashboards.consultants.show');
    }
    
    public function orders()
    {
        return view('dashboards.consultants.orders');
    }

    // public function consultationRequest()
    // {
    //     return view('consultants.consultation-request');
    // }

    // public function consultationRequests()
    // {
    //     return view('consultants.requests');
    // }

    public function profile()
    {  // Get the authenticated user
        $user = Auth::user();
        
        // Get the consultant data associated with this user
        $consultant = Consultant::where('user_id', $user->id)->first();
        
        return view('dashboards.consultants.profile', compact('user', 'consultant'));
    }
}
