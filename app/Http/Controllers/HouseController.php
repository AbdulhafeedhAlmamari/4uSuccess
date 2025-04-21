<?php

namespace App\Http\Controllers;

use App\Models\Housing;

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
    
}
