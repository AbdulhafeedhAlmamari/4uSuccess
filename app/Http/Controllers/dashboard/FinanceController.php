<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\FinancingCompany;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinanceController extends Controller
{
    public function index()
    {
        return view('dashboards.finances.index');
    }

    public function show()
    {
        return view('dashboards.finances.show');
    }

    public function orders()
    {
        return view('dashboards.finances.orders');
    }

    public function profile()
    {
        // Get the authenticated user
        $user = Auth::user();
        
        // Get the financing company data
        $financingCompany = FinancingCompany::where('user_id', $user->id)->first();
        
        return view('dashboards.finances.profile', compact('user', 'financingCompany'));
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

            // Get the financing company data
            $financingCompany = FinancingCompany::where('user_id', $user->id)->first();
            
            if (!$financingCompany) {
                $financingCompany = new FinancingCompany();
                $financingCompany->user_id = $user->id;
            }

            // Update financing company information
            $financingCompany->commercial_register_number = $request->commercial_register_number;
            $financingCompany->phone_number = $request->phone_number;

            // Handle identity image upload
            if ($request->hasFile('identity_image')) {
                // Delete old image if exists
                if ($financingCompany->identity_image && file_exists(public_path($financingCompany->identity_image))) {
                    unlink(public_path($financingCompany->identity_image));
                }
                
                $image = $request->file('identity_image');
                $imageName = 'identity_' . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'images/finances/' . $imageName;
                
                // Make sure the directory exists
                if (!file_exists(public_path('images/finances'))) {
                    mkdir(public_path('images/finances'), 0755, true);
                }
                
                $image->move(public_path('images/finances'), $imageName);
                $financingCompany->identity_image = $imagePath;
            }

            // Handle commercial register image upload
            if ($request->hasFile('commercial_register_image')) {
                // Delete old image if exists
                if ($financingCompany->commercial_register_image && file_exists(public_path($financingCompany->commercial_register_image))) {
                    unlink(public_path($financingCompany->commercial_register_image));
                }
                
                $image = $request->file('commercial_register_image');
                $imageName = 'commercial_' . time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'images/finances/' . $imageName;
                
                // Make sure the directory exists
                if (!file_exists(public_path('images/finances'))) {
                    mkdir(public_path('images/finances'), 0755, true);
                }
                
                $image->move(public_path('images/finances'), $imageName);
                $financingCompany->commercial_register_image = $imagePath;
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
            $financingCompany->save();

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
