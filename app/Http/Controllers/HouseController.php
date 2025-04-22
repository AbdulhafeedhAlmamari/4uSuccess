<?php

namespace App\Http\Controllers;

use App\Models\Housing;
use App\Models\ReservationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseController extends Controller
{
    public function index()
    {
        $houses = Housing::with(['primaryPhoto', 'housingCompany'])->get();

        return view('houses.index', compact('houses'));
    }

    public function show($id)
    {
        $house = Housing::with(['primaryPhoto', 'photos'])->findOrFail($id);

        $relatedHouses = Housing::with('primaryPhoto')
            ->where('id', '!=', $house->id)
            ->where('housing_type', $house->housing_type)
            ->limit(4)
            ->get();

        return view('houses.show', compact('house', 'relatedHouses'));
    }


    public function reservationStore(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'housing_id' => 'required|exists:housing,id',
        ]);
        // Create the reservation
        $reservation = ReservationRequest::create([
            'student_id' => Auth::id(),
            'housing_id' => $validated['housing_id'],
            'reservation_type' => 'housing',
            'status' => 'pending', // Default status is pending
            'request_date' => now(),
        ]);

        return redirect()->route('home')->with('success', 'تم إرسال طلب الحجز بنجاح. سيتم إشعارك عند الموافقة عليه.');
    }
}
