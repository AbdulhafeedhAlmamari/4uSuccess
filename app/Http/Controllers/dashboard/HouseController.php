<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Housing;
use App\Models\HousingCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HouseController extends Controller
{
    public function index()
    {
        return view('dashboards.houses.index');
    }
    public function getAllHouses()
    {
        //     $houses = Housing::all();
        //     return view('dashboards.houses.houses', compact('houses'));
        return view('dashboards.houses.houses');
    }
    public function show()
    {
        return view('dashboards.houses.show');
    }

    public function orders()
    {
        return view('dashboards.houses.orders');
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
}
