<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Consultant;
use App\Models\Student;
use App\Models\HousingCompany;
use App\Models\TransportationCompany;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with all necessary data
     */
    public function index()
    {
        // Count users by role
        $studentsCount = User::where('role', 'student')->count();
        $consultantsCount = User::where('role', 'consultant')->count();
        $housingCount = User::where('role', 'housing')->count();
        $transportationCount = User::where('role', 'transportation')->count();
        $financeCount = User::where('role', 'financing')->count();

        // Get consultant requests (pending, approved, rejected)
        $pendingConsultants = User::where('is_approved', 0)->count();
        $approvedConsultants = User::where('is_approved', 1)->count();
        $rejectedConsultants = User::where('is_approved', 2)->count();


        // Get all users with their respective role details
        $users = User::latest()->get();
        // get with latest data
        $usersRequest = User::latest()->get();
        // $usersRequest = User::where('is_approved', 0)->get();

        return view('dashboards.admin.index', compact(
            'studentsCount',
            'consultantsCount',
            'financeCount',
            'housingCount',
            'transportationCount',
            'pendingConsultants',
            'approvedConsultants',
            'rejectedConsultants',
            'usersRequest',
            'users'
        ));
    }
    public function contact()
    {
        return view('dashboards.admin.contact');
    }

    /**
     * Update consultant is_approved 
     */
    public function updateUserRequest(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = $request->is_approved;
        $user->save();

        return redirect()->back()->with('success', 'تم تحديث حساب المستخدم بنجاح');
    }

    /**
     * Get all users
     */
    public function getUsers()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Delete user
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back()->with('success', 'تم حذف المستخدم بنجاح');
    }

    public function showUser()
    {
        return view('dashboards.admin.index');
    }
}
