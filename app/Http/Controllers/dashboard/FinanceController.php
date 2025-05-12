<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\FinanceRequest;
use App\Models\FinancingCompany;
use App\Models\Installment;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FinanceController extends Controller
{
    public function index()
    {
        // count all finance requests
        $financeRequests = FinanceRequest::where('financing_company_id', Auth::user()->id)->count();
        // count all finance requests with status 'under_review'
        $underReviewCount = FinanceRequest::where('financing_company_id', Auth::user()->id)
            ->where('status', 'under_review')->count();
        // count all finance requests with status 'accepted'
        $acceptedCount = FinanceRequest::where('financing_company_id', Auth::user()->id)
            ->where('status', 'accepted')->count();
        // count all finance requests with status 'rejected'
        $rejectedCount = FinanceRequest::where('financing_company_id', Auth::user()->id)
            ->where('status', 'rejected')->count();
        // count all finance requests with status 'completed'
        $completedCount = FinanceRequest::where('financing_company_id', Auth::user()->id)
            ->where('status', 'completed')->count();

        return view('dashboards.finances.index', compact('financeRequests', 'underReviewCount', 'acceptedCount', 'rejectedCount', 'completedCount'));
    }

    public function show()
    {
        return view('dashboards.finances.show');
    }

    public function showDetails()
    {
        return view('dashboards.finances.details');
    }

    public function orders($status)
    {
        $financeRequests = FinanceRequest::where('financing_company_id', Auth::user()->id)
            ->where('status', $status)
            ->get();
        return view('dashboards.finances.orders', compact('financeRequests', 'status'));
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
            Log::error('Profile update error: ' . $e->getMessage());

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

    // Reject a finance request
    public function reject(Request $request, $id)
    {
        $financeRequest = FinanceRequest::findOrFail($id);

        // Update the status to 'rejected' and save the rejection reason
        $financeRequest->status = 'rejected';
        $financeRequest->reply = $request->input('reply');
        $financeRequest->save();

        return redirect()->back()->with('success', 'تم رفض الطلب بنجاح.');
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:finance_requests,id',
            'status' => 'required|in:under_review,accepted,rejected,completed',
        ]);

        $financeRequest = FinanceRequest::findOrFail($request->id);
        $financeRequest->status = $request->status;
        $financeRequest->save();

        if ($request->status === 'accepted') {
            $installment = $this->createInstallments($financeRequest);
            // dd($installment);
        }

        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح.');
    }


    public function createInstallments(FinanceRequest $financeRequest)
    {

        // Check if user is authorized to create installments for this finance request
        if (Auth::id() !== $financeRequest->financing_company_id) {
            abort(403, 'Unauthorized action.');
        }

        // Check if installments already exist
        if ($financeRequest->installments()->count() > 0) {
            return redirect()->back()->with('error', 'الأقساط موجودة بالفعل لهذا الطلب');
        }

        $installmentPeriod = $financeRequest->installment_period;



        // Calculate installment amount
        $installmentAmount = round($financeRequest->amount / $installmentPeriod, 2);

        // Create installments
        for ($i = 1; $i <= $installmentPeriod; $i++) {
            $dueDate = Carbon::now()->addMonths($i);

            $arabicNumbers = [
                'الأول', 'الثاني', 'الثالث', 'الرابع', 'الخامس', 'السادس',
                'السابع', 'الثامن', 'التاسع', 'العاشر', 'الحادي عشر', 'الثاني عشر'
            ];

            $installmentName = 'القسط ' . ($i <= 12 ? $arabicNumbers[$i - 1] : $i);
            // dd($financeRequest);
            $installment =  Installment::create([
                'finance_request_id' => $financeRequest->id,
                'user_id' => $financeRequest->student_id,
                'name' => $installmentName,
                'amount' => $installmentAmount,
                'due_date' => $dueDate,
                'status' => 'unpaid'
            ]);
            // dd($installment);
            Invoice::create([
                'installment_id' => $installment->id,
                'amount_invoice' => $installmentAmount,
                'vat' =>  15,
                'service_fee' => 23,
                'type_invoice' => 'installment',
                'user_id' => Auth::id(),
                'status' => 'pending',
                'date_invoice' => now(),
            ]);
        }

        return $installment;
    }
}
