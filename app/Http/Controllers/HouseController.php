<?php

namespace App\Http\Controllers;

use App\Models\Housing;
use App\Models\ReservationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseController extends Controller
{
    /**
     * Display a listing of the houses with search and filter functionality.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Housing::with('primaryPhoto', 'photos');

        // Search by address or description
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('address', 'like', '%' . $searchTerm . '%')
                  ->orWhere('description', 'like', '%' . $searchTerm . '%')
                  ->orWhere('features', 'like', '%' . $searchTerm . '%')
                  ->orWhere('housing_type', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter by distance
        if ($request->has('distance') && !empty($request->distance)) {
            // Extract numeric value from distance_from_university field
            $query->whereRaw('CAST(SUBSTRING_INDEX(distance_from_university, " ", 1) AS DECIMAL(10,2)) <= ?', [$request->distance]);
        }

        // Filter by price
        if ($request->has('price') && !empty($request->price)) {
            $query->where('price', '<=', $request->price);
        }

        $houses = $query->get();

        return view('houses.index', compact('houses'));
    }

    /**
     * Display the specified house.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
