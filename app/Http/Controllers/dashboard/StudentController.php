<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\ConsultationRequest;
use App\Models\FinanceRequest;
use App\Models\ReservationRequest;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        return view('dashboards.students.index');
    }

    public function show()
    {
        return view('dashboards.students.show');
    }

    public function orders()
    {
        $consultationRequests = ConsultationRequest::with('student', 'consultant')->latest()
            ->where('student_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        $financeRequests = FinanceRequest::where('student_id', Auth::id())
            ->with('student', 'financingCompany', 'installments')
            ->orderBy('created_at', 'desc')
            ->get();

        $housingRequests = ReservationRequest::with([
            'housing.housingCompany', // Load housing company and user
        ])->where('reservation_type', 'housing')
            ->where('student_id', Auth::id())->get();

        $transportationRequests = ReservationRequest::with([
            'trip.transportationCompany', // Load housing company and user
        ])->where('reservation_type', 'transportation')
            ->where('student_id', Auth::id())
            ->get();

        return view('dashboards.students.orders', compact('consultationRequests', 'financeRequests', 'transportationRequests', 'housingRequests'));
    }

    public function installment()
    {
        return view('dashboards.students.installment');
    }
    public function profile()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get the student data associated with this user
        $student = Student::where('user_id', $user->id)->first();

        return view('dashboards.students.profile', compact('user', 'student'));
    }

    public function updateProfile(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'university_number' => 'required|string|max:255',
            'university_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'studentIdUpload' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        // dd($request->all());
        // Get the authenticated user
        $user = Auth::user();

        // Update user information
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Get the student data associated with this user
        $student = Student::where('user_id', $user->id)->first();

        // Update student information
        $student->university_number = $request->university_number;
        $student->university_name = $request->university_name;
        $student->student_phone_number = $request->phone;
        $student->student_address = $request->address;

        // Handle profile image upload
        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/profiles'), $imageName);
            $user->profile_image = 'images/profiles/' . $imageName;
            $user->save();
        }
        // dd($user->student->studentIdUpload);
        // Handle profile image upload

        if ($request->hasFile('studentIdUpload')) {
            // Delete old image if exists
            if ($student->studentIdUpload && file_exists(public_path($student->studentIdUpload))) {
                unlink(public_path($student->studentIdUpload));
            }

            $image = $request->file('studentIdUpload');
            $imageName =  time() . '.' . $image->getClientOriginalExtension();
            $imagePath = 'images/students/' . $imageName;

            // Make sure the directory exists
            if (!file_exists(public_path('images/students'))) {
                mkdir(public_path('images/students'), 0755, true);
            }

            $image->move(public_path('images/students'), $imageName);
            $student->studentIdUpload = $imagePath;
        }


        $student->save();

        // Return success response for AJAX request
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'تم تحديث الملف الشخصي بنجاح'
            ]);
        }

        // Redirect with success message for non-AJAX request
        return redirect()->back()->with('success', 'تم تحديث الملف الشخصي بنجاح');
    }
}
