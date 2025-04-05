<?php

namespace App\Http\Controllers;

class ConsultantController extends Controller
{
    public function index()
    {
        return view('consultants.index');
    }

    public function show()
    {
        return view('consultants.show');
    }

    public function consultationRequest()
    {
        return view('consultants.consultation-request');
    }

    public function consultationRequests()
    {
        return view('consultants.requests');
    }
}
