<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;


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
    {
        return view('dashboards.consultants.profile');
    }
}
