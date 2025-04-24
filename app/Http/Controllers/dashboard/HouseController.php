<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Housing;
use App\Models\HousingCompany;
use App\Models\Photo;
use App\Models\ReservationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class HouseController extends Controller
{
    public function index()
    {
        // Get counts of pending and confirmed orders
        $pendingOrdersCount = ReservationRequest::where('status', 'pending')->where('reservation_type', 'housing')->count();
        $confirmedOrdersCount = ReservationRequest::where('status', 'confirmed')->where('reservation_type', 'housing')->count();

        return view('dashboards.houses.index', compact('pendingOrdersCount', 'confirmedOrdersCount'));
    }
    public function getAllHouses()
    {
        // Get the authenticated user's housing company
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('home')->with('error', 'You do not have a housing company profile.');
        }
        // Get all housing listings for this company
        $housings = Housing::where('housing_company_id', $user->id)->get();

        return view('dashboards.houses.houses', compact('housings'));
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

        try {
            // Get the authenticated user's housing company
            $user = Auth::user();

            if (!$user) {
                return redirect()->back()->with('error', 'You do not have a housing company profile.');
            }

            // Create the housing record
            $housing = Housing::create([
                'housing_company_id' =>  $user->id,
                'address' => $validated['address'],
                'description' => $validated['description'],
                'price' => $validated['price'],
                'housing_type' => $validated['housing_type'],
                'rules' => $validated['rules'],
                'distance_from_university' => $validated['distance_from_university'],
                'features' => $validated['features'],
            ]);

            if ($request->hasFile('primary_image')) {
                $image = $request->file('primary_image');
                $imageName = 'primary_' . time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/houses'), $imageName);

                // Save path accessible via asset()
                Photo::create([
                    'housing_id' => $housing->id,
                    'path' => 'images/houses/' . $imageName,
                    'is_primary' => true,
                ]);
            }


            // Handle additional images upload
            if ($request->hasFile('additional_images')) {
                foreach ($request->file('additional_images') as $image) {
                    $imageName =  time() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('images/houses'), $imageName);
                    // Create photo record
                    Photo::create([
                        'housing_id' => $housing->id,
                        'path' => 'images/houses/' . $imageName,
                        'is_primary' => false,
                    ]);
                }
            }
            return redirect()->route('dashboard.all_houses')->with('success', 'Housing added successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while adding housing.')->withInput();
        }
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
            return redirect()->route('dashboard.all_houses')->with('error', 'Unauthorized access.');
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
        if ($housing->user_id !== Auth::user()->id) {
            return redirect()->route('dashboard.all_houses')->with('error', 'Unauthorized access.');
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
    public function update(Request $request,  $id)
    {
        $housing = Housing::findOrFail($id);
        // Check if the housing belongs to the authenticated user's company
        if ($housing->user_id !== Auth::user()->user_id) {
            return redirect()->route('dashboard.all_houses')->with('error', 'Unauthorized access.');
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
                if ($request->hasFile('image')) {
                    // Delete old image if exists
                    if ($existingPrimary->path && file_exists(public_path($existingPrimary->path))) {
                        unlink(public_path($existingPrimary->path));
                    }

                    $image = $request->file('image');
                    $imageName = 'primary_' . time() . '.' . $image->getClientOriginalExtension();
                    $imagePath = 'images/houses/' . $imageName;

                    // Make sure the directory exists
                    if (!file_exists(public_path('images/houses'))) {
                        mkdir(public_path('images/transportations'), 0755, true);
                    }

                    $image->move(public_path('images/houses'), $imageName);
                    $existingPrimary->path = $imagePath;
                    Photo::create([
                        'housing_id' => $housing->id,
                        'path' => 'images/houses/' . $imageName,
                        'is_primary' => true,
                    ]);
                }
                $existingPrimary->delete();
            }
        }
        if ($request->hasFile('additional_images')) {

            $oldAdditionalImages = $housing->photos()->where('is_primary', false)->get();

            foreach ($oldAdditionalImages as $oldImage) {
                if ($oldImage->path && file_exists(public_path($oldImage->path))) {
                    unlink(public_path($oldImage->path));
                }
                $oldImage->delete();
            }

            // رفع الصور الجديدة وتخزينها
            foreach ($request->file('additional_images') as $image) {
                $imageName = 'housing_' . $housing->id . '_' . Str::random(10) . '_' . time() . '.' . $image->getClientOriginalExtension();
                $storagePath = 'housing_images/' . $imageName;
                $image->move(public_path('storage/housing_images'), $imageName);
                Photo::create([
                    'housing_id' => $housing->id,
                    'path' => 'images/houses/' . $imageName,
                    'is_primary' => false,
                ]);
            }
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

        return redirect()->route('dashboard.all_houses')->with('success', 'Housing updated successfully.');
    }

    /**
     * Remove the specified housing from storage.
     *
     * @param  \App\Models\Housing  $housing
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $housing = Housing::findOrFail($id);

        // Check if the housing belongs to the authenticated user's company
        if ($housing->user_id !== Auth::user()->user_id) {
            return redirect()->route('dashboard.all_houses')->with('error', 'Unauthorized access.');
        }

        // Delete all associated photos and their files
        foreach ($housing->photos as $photo) {
            $filePath = public_path($photo->path);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            $photo->delete();
        }


        // Delete the housing record
        $housing->delete();

        return redirect()->route('dashboard.all_houses')->with('success', 'Housing deleted successfully.');
    }

    public function orders($status)
    {
        $housingCompanyId = auth()->user()->id;

        $reservations = ReservationRequest::with(['student', 'housing'])
            ->whereNotNull('housing_id')
            ->where('status', $status)
            ->whereHas('housing', function ($query) use ($housingCompanyId) {
                $query->where('housing_company_id', $housingCompanyId);
            })
            ->latest()
            ->get();
        return view('dashboards.houses.orders', compact('reservations', 'status'));
    }
    public function updateStatus(Request $request, ReservationRequest $reservation)
    {
        $request->validate([
            'status' => 'required|in:confirmed,rejected',
            'reply' => 'nullable|string',

        ]);

        $reservation->status = $request->status;
        $reservation->save();

        return back()->with('success', 'تم تحديث حالة الطلب بنجاح');
    }

    public function profile()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get the housing company data
        $housingCompany = HousingCompany::where('user_id', $user->id)->first();

        return view('dashboards.houses.profile', compact('user', 'housingCompany'));
    }

    public function updateProfile(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|string|max:20',
                'commercial_register_number' => 'required|string|max:255',
                // 'address' => 'nullable|string|max:500',
                'identity_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'commercial_register_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Get the authenticated user
            $user = Auth::user();

            // Update user information
            $user->name = $request->name;
            $user->email = $request->email;

            // Get the housing company data
            $housingCompany = HousingCompany::where('user_id', $user->id)->first();

            if (!$housingCompany) {
                $housingCompany = new HousingCompany();
                $housingCompany->user_id = $user->id;
            }

            // Update housing company information
            $housingCompany->commercial_register_number = $request->commercial_register_number;
            $housingCompany->phone_number = $request->phone_number;
            // $housingCompany->address = $request->address;

            // Handle identity image upload
            if ($request->hasFile('identity_image')) {
                // Delete old image if exists
                if ($housingCompany->identity_image && file_exists(public_path($housingCompany->identity_image))) {
                    unlink(public_path($housingCompany->identity_image));
                }

                $image = $request->file('identity_image');
                $imageName = 'identity_' . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'images/houses/' . $imageName;

                // Make sure the directory exists
                if (!file_exists(public_path('images/houses'))) {
                    mkdir(public_path('images/houses'), 0755, true);
                }

                $image->move(public_path('images/houses'), $imageName);
                $housingCompany->identity_image = $imagePath;
            }

            // Handle commercial register image upload
            if ($request->hasFile('commercial_register_image')) {
                // Delete old image if exists
                if ($housingCompany->commercial_register_image && file_exists(public_path($housingCompany->commercial_register_image))) {
                    unlink(public_path($housingCompany->commercial_register_image));
                }

                $image = $request->file('commercial_register_image');
                $imageName = 'commercial_' . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'images/houses/' . $imageName;

                // Make sure the directory exists
                if (!file_exists(public_path('images/houses'))) {
                    mkdir(public_path('images/houses'), 0755, true);
                }

                $image->move(public_path('images/houses'), $imageName);
                $housingCompany->commercial_register_image = $imagePath;
            }

            // Handle profile image upload
            if ($request->hasFile('profile_image')) {
                // Delete old image if exists
                if ($user->profile_image && file_exists(public_path($user->profile_image))) {
                    unlink(public_path($user->profile_image));
                }

                $image = $request->file('profile_image');
                $imageName = 'profile_' . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'images/profiles/' . $imageName;

                // Make sure the directory exists
                if (!file_exists(public_path('images/profiles'))) {
                    mkdir(public_path('images/profiles'), 0755, true);
                }

                $image->move(public_path('images/profiles'), $imageName);
                $user->profile_image = $imagePath;
            }

            // Save the changes
            $user->save();
            $housingCompany->save();

            // Return success response for AJAX request
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'تم تحديث الملف الشخصي بنجاح'
                ]);
            }

            // Redirect with success message for non-AJAX request
            return redirect()->back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
        } catch (\Exception $e) {

            // Return error response for AJAX request
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'حدث خطأ أثناء تحديث الملف الشخصي: ' . $e->getMessage()
                ], 500);
            }

            // Redirect with error message for non-AJAX request
            return redirect()->back()->with('error', 'حدث خطأ أثناء تحديث الملف الشخصي');
        }
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
