<?php

namespace App\Http\Controllers;

use App\Models\ReservationRequest;
use App\Models\Trip;
use Illuminate\Http\Request;

class TransportController extends Controller
{
    public function index()
    {
        return view('transports.index');
    }

    public function show($type)
    {

        return view('transports.show', compact('type'));
    }

    public function search($type)
    {
        return view('transports.search', compact('type'));
    }

    public function searchResult()
    {
        $trips = Trip::all();

        return view('transports.search-result', compact('trips'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'transport_id' => 'required|exists:trips,id',
        ]);
        // Create the reservation
        $reservation = ReservationRequest::create([
            'student_id' => auth()->user()->id,
            'trip_id' => $validated['transport_id'],
            'reservation_type' => 'transportation',
            'status' => 'pending',
            'request_date' => now(),
        ]);

        return redirect()->route('home.transport.search')->with('success', 'تم إرسال طلب الحجز بنجاح. سيتم إشعارك عند الموافقة عليه.');
    }

    public function searchForTrip(Request $request)
    {
        // Validate inputs
        $request->validate([
            'departure_station' => 'nullable|string|max:255',
            'arrival_station'   => 'nullable|string|max:255',
            'departure_date'    => 'nullable|date',
            'return_date'       => 'nullable|date|after_or_equal:departure_date',
            'seats'             => 'nullable|integer|min:1',
            'trip_type'         => 'required|in:one_way,round_trip',
        ]);
        // dd($request->all());
        $query = Trip::query();
        // dd($request->all());
        // Apply filters just like the static example
        if ($request->filled('departure_station')) {
            $query->where('start', 'like', '%' . $request->departure_station . '%');
            // dd($query->get());
        }

        if ($request->filled('arrival_station')) {
            $query->where('end', 'like', '%' . $request->arrival_station . '%');
        }

        if ($request->filled('departure_date')) {
            $query->whereDate('go_date', $request->departure_date);
        }

        if ($request->trip_type === 'round_trip' && $request->filled('return_date')) {
            $query->whereDate('back_date', $request->return_date);
        }

        if ($request->filled('seats')) {
            $query->where('number_of_seats', '>=', $request->seats);
        }

        $query->where('trip_type', $request->trip_type);
        $trips = $query->get();

        // Run the query and return results

        return view('transports.search-result', compact('trips'));
    }
}
