<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use Illuminate\Http\Request;

class ConsultantController extends Controller
{
    public function index(Request $request)
    {
        $query = Consultant::query();
        // Filter by specialization if provided
        if ($request->has('specialization') && !empty($request->specialization)) {
            $query->where('specialization', $request->specialization);
        }

        // // Filter by gender if provided
        if ($request->has('gender') && !empty($request->gender)) {
            $query->where('gender', $request->gender);
        }

        // Get all consultants based on filters
        $consultants = $query->get();
        return view('consultants.index', compact('consultants'));
    }

    public function show($id)
    {
        $consultant = Consultant::findOrFail($id);
        return view('consultants.show', compact('consultant'));
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
