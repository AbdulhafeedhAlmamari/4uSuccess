<?php

namespace App\Http\Controllers;

use App\Models\Housing;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HousingController extends Controller
{
    /**
     * Display a listing of the housing.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the authenticated user's housing company
        // $housingCompany = Auth::user()->housingCompany;

        // if (!$housingCompany) {
        //     return redirect()->route('dashboard')->with('error', 'You do not have a housing company profile.');
        // }

        // Get all housing listings for this company
        // $housings = Housing::where('housing_company_id', $housingCompany->user_id)->get();

        return view('dashboards.houses.houses');
    }

    /**
     * Store a newly created housing in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'housing_type' => 'required|string|max:255',
            'rules' => 'required|string',
            'distance_from_university' => 'required|string|max:255',
            'features' => 'required|string|max:255',
        ]);

        // Get the authenticated user's housing company
        $housingCompany = Auth::user()->housingCompany;

        if (!$housingCompany) {
            return redirect()->back()->with('error', 'You do not have a housing company profile.');
        }

        // Create the housing record
        $housing = Housing::create([
            'housing_company_id' => 1,
            'address' => $validated['address'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'housing_type' => $validated['housing_type'],
            'rules' => $validated['rules'],
            'distance_from_university' => $validated['distance_from_university'],
            'features' => $validated['features'],
        ]);

        // Handle primary image upload
        if ($request->hasFile('primary_image')) {
            $primaryImage = $request->file('primary_image');
            $primaryImageName = 'housing_' . $housing->id . '_primary_' . time() . '.' . $primaryImage->getClientOriginalExtension();
            $primaryImage->storeAs('public/housing_images', $primaryImageName);

            // Create primary photo record
            Photo::create([
                'housing_id' => $housing->id,
                'path' => 'storage/housing_images/' . $primaryImageName,
                'is_primary' => true,
            ]);
        }

        // Handle additional images upload
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $imageName = 'housing_' . $housing->id . '_' . Str::random(10) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/housing_images', $imageName);

                // Create photo record
                Photo::create([
                    'housing_id' => $housing->id,
                    'path' => 'storage/housing_images/' . $imageName,
                    'is_primary' => false,
                ]);
            }
        }

        return redirect()->route('housing.index')->with('success', 'Housing added successfully.');
    }

    /**
     * Display the specified housing.
     *
     * @param  \App\Models\Housing  $housing
     * @return \Illuminate\Http\Response
     */
    public function show(Housing $housing)
    {
        // Check if the housing belongs to the authenticated user's company
        if ($housing->housing_company_id !== Auth::user()->housingCompany->user_id) {
            return redirect()->route('housing.index')->with('error', 'Unauthorized access.');
        }

        return view('dashboards.houses.show', compact('housing'));
    }

    /**
     * Show the form for editing the specified housing.
     *
     * @param  \App\Models\Housing  $housing
     * @return \Illuminate\Http\Response
     */
    public function edit(Housing $housing)
    {
        // Check if the housing belongs to the authenticated user's company
        if ($housing->housing_company_id !== Auth::user()->housingCompany->user_id) {
            return redirect()->route('housing.index')->with('error', 'Unauthorized access.');
        }

        return view('dashboards.houses.edit', compact('housing'));
    }

    /**
     * Update the specified housing in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Housing  $housing
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Housing $housing)
    {
        // Check if the housing belongs to the authenticated user's company
        if ($housing->housing_company_id !== Auth::user()->housingCompany->user_id) {
            return redirect()->route('housing.index')->with('error', 'Unauthorized access.');
        }

        // Validate the request
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'housing_type' => 'required|string|max:255',
            'rules' => 'required|string',
            'distance_from_university' => 'required|string|max:255',
            'features' => 'required|string|max:255',
        ]);

        // Update the housing record
        $housing->update($validated);

        // Handle primary image upload if provided
        if ($request->hasFile('primary_image')) {
            // Delete existing primary image if exists
            $existingPrimary = $housing->primaryPhoto;
            if ($existingPrimary) {
                Storage::delete(str_replace('storage/', 'public/', $existingPrimary->path));
                $existingPrimary->delete();
            }

            // Upload new primary image
            $primaryImage = $request->file('primary_image');
            $primaryImageName = 'housing_' . $housing->id . '_primary_' . time() . '.' . $primaryImage->getClientOriginalExtension();
            $primaryImage->storeAs('public/housing_images', $primaryImageName);

            // Create primary photo record
            Photo::create([
                'housing_id' => $housing->id,
                'path' => 'storage/housing_images/' . $primaryImageName,
                'is_primary' => true,
            ]);
        }

        // Handle additional images upload if provided
        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $imageName = 'housing_' . $housing->id . '_' . Str::random(10) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/housing_images', $imageName);

                // Create photo record
                Photo::create([
                    'housing_id' => $housing->id,
                    'path' => 'storage/housing_images/' . $imageName,
                    'is_primary' => false,
                ]);
            }
        }

        return redirect()->route('housing.index')->with('success', 'Housing updated successfully.');
    }

    /**
     * Remove the specified housing from storage.
     *
     * @param  \App\Models\Housing  $housing
     * @return \Illuminate\Http\Response
     */
    public function destroy(Housing $housing)
    {
        // Check if the housing belongs to the authenticated user's company
        if ($housing->housing_company_id !== Auth::user()->housingCompany->user_id) {
            return redirect()->route('housing.index')->with('error', 'Unauthorized access.');
        }

        // Delete all associated photos and their files
        foreach ($housing->photos as $photo) {
            Storage::delete(str_replace('storage/', 'public/', $photo->path));
            $photo->delete();
        }

        // Delete the housing record
        $housing->delete();

        return redirect()->route('housing.index')->with('success', 'Housing deleted successfully.');
    }

    /**
     * Handle temporary file uploads for Dropzone.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadTemp(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = 'temp_' . time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/temp', $filename);

            return response()->json(['success' => true, 'filename' => $filename]);
        }

        return response()->json(['success' => false]);
    }
}
