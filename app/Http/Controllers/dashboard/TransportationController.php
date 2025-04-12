<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\TransportationCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransportationController extends Controller
{
    public function index()
    {
        return view('dashboards.transportations.index');
    }

    public function show()
    {
        return view('dashboards.transportations.show');
    }

    public function orders()
    {
        return view('dashboards.transportations.orders');
    }


    public function profile()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get the transportation company data
        $transportationCompany = TransportationCompany::where('user_id', $user->id)->first();

        return view('dashboards.transportations.profile', compact('user', 'transportationCompany'));
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
                'identity_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'commercial_register_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Get the authenticated user
            $user = Auth::user();

            // Update user information
            $user->name = $request->name;
            $user->email = $request->email;

            // Get the transportation company data
            $transportationCompany = TransportationCompany::where('user_id', $user->id)->first();

            if (!$transportationCompany) {
                $transportationCompany = new TransportationCompany();
                $transportationCompany->user_id = $user->id;
            }

            // Update transportation company information
            $transportationCompany->commercial_register_number = $request->commercial_register_number;
            $transportationCompany->phone_number = $request->phone_number;

            // Handle identity image upload
            if ($request->hasFile('identity_image')) {
                // Delete old image if exists
                if ($transportationCompany->identity_image && file_exists(public_path($transportationCompany->identity_image))) {
                    unlink(public_path($transportationCompany->identity_image));
                }

                $image = $request->file('identity_image');
                $imageName = 'identity_' . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'images/transportations/' . $imageName;

                // Make sure the directory exists
                if (!file_exists(public_path('images/transportations'))) {
                    mkdir(public_path('images/transportations'), 0755, true);
                }

                $image->move(public_path('images/transportations'), $imageName);
                $transportationCompany->identity_image = $imagePath;
            }

            // Handle commercial register image upload
            if ($request->hasFile('commercial_register_image')) {
                // Delete old image if exists
                if ($transportationCompany->commercial_register_image && file_exists(public_path($transportationCompany->commercial_register_image))) {
                    unlink(public_path($transportationCompany->commercial_register_image));
                }

                $image = $request->file('commercial_register_image');
                $imageName = 'commercial_' . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'images/transportations/' . $imageName;

                // Make sure the directory exists
                if (!file_exists(public_path('images/transportations'))) {
                    mkdir(public_path('images/transportations'), 0755, true);
                }

                $image->move(public_path('images/transportations'), $imageName);
                $transportationCompany->commercial_register_image = $imagePath;
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
            $transportationCompany->save();

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
            // Log the error
            \Log::error('Profile update error: ' . $e->getMessage());

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
