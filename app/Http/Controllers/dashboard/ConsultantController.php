<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Consultant;
use App\Models\ConsultationRequest;
use Illuminate\Support\Facades\Auth;

class ConsultantController extends Controller
{
    public function index()
    {
        $pendingOrdersCount = ConsultationRequest::where('status', 'pending')->where('consultant_id', Auth::user()->id)->count();
        $acceptedOrdersCount = ConsultationRequest::where('status', 'accepted')->where('consultant_id', Auth::user()->id)->count();
        $rejectedOrdersCount = ConsultationRequest::where('status', 'rejected')->where('consultant_id', Auth::user()->id)->count();

        return view('dashboards.consultants.index', compact('pendingOrdersCount', 'acceptedOrdersCount', 'rejectedOrdersCount'));
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
