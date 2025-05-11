<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function rate(Request $request)
    {
        if (Auth::guest()) {
            return response()->json([
                'success' => false,
                'message' => 'يجب تسجيل الدخول اولا'
            ]);
        }
        $value = $request->input('value');
        $consultant_id = $request->input('consultant_id');
        // dd($value, $housing_id);
        $consultant = User::find($consultant_id);
// dd($consultant);
        $rating = auth()->user()->ratings()->updateOrCreate(['consultant_id' => $consultant->id], ['value' => $value]);
        return response()->json([
            'success' => true,
            'rating' => $rating->value,
            'averageRating' => $consultant->rate(),
            'message' => 'تم تقييم المنزل بنجاح'
        ]);
    }
}
